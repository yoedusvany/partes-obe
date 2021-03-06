<?php

namespace App\Http\Controllers;

use App\Orden;
use App\Service;
use App\Sucursal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Orden::where('ejecutado', "=", 0)->get();

        foreach ($data as $key => $value) {
            $data[$key]->sucursal = Sucursal::find($value->sucursales_id)->name;
            $data[$key]->servicio = Service::find($value->services_id)->name;
            $data[$key]->dias = Carbon::now()->diffInDays($value->fecha);
        }
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orden = new Orden();
        $orden->no_serie = $request->get('noSerie');
        $orden->fecha = $request->get('fecha');
        $orden->cliente = $request->get('cliente');
        $orden->dir = $request->get('dir');
        $orden->ejecutado = false;
        $orden->fecha_ejecucion = "";
        $orden->services_id = $request->get('servicio');
        $orden->sucursales_id = $request->get('sucursal');

        if ($orden->save()) {
            return response()->json(true, 200);
        } else {
            return response()->json(false, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orden = Orden::find($id);
        $orden->sucursal = Sucursal::find($orden->sucursales_id)->name;
        $orden->servicio = Service::find($orden->services_id)->name;
        return response()->json($orden,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $orden = Orden::find($id);
        $orden->no_serie = $request->get('noSerie');
        $orden->sucursales_id = $request->get('sucursal');
        $orden->services_id = $request->get('servicio');
        $orden->cliente = $request->get('cliente');
        $orden->dir = $request->get('dir');
        $orden->fecha = $request->get('fecha');

        if($orden->save()){
            return response()->json(true, 200);
        }else{
            return response()->json(false, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orden = Orden::find($id);

        if ($orden) {
            if ($orden->delete()) {
                return response()->json(true, 200);
            }
        }

        return response()->json(false, 500);
    }

    /**
     * Get summary
     */
    public function getDataRango($sucursal_id, $service_id, $ejecutado = 0)
    {
        $ordenes = Orden::where('ejecutado', $ejecutado)
            ->where('sucursales_id', $sucursal_id)
            ->where('services_id', $service_id)
            ->get();

        $rangos = array(
            '0-10' => 0,
            '11-30' => 0,
            '31-90' => 0,
            '91-180' => 0,
            '>180' => 0
        );

        foreach ($ordenes as $orden) {
            $dias = Carbon::now()->diffInDays($orden->fecha);

            if ($dias < 10) {
                $rangos['0-10']++;
            } elseif ($dias > 10 && $dias <= 30) {
                $rangos['11-30']++;
            } elseif ($dias > 30 && $dias <= 90) {
                $rangos['31-90']++;
            } elseif ($dias > 91 && $dias <= 180) {
                $rangos['91-180']++;
            } else {
                $rangos['>180']++;
            }
        }

        return $rangos;
    }

    public function getAllRangos()
    {
        $sucursales = Sucursal::all();
        $servicios = Service::all();
        $rangos = array();

        foreach ($servicios as $servicio) {
            foreach ($sucursales as $sucursal) {
                $rangos[$sucursal->id . '-' . $servicio->id] = $this->getDataRango($sucursal->id, $servicio->id);
            }
        }

        return response()->json($rangos, 200);
    }

    public function getAllRangosEjecutados()
    {
        $sucursales = Sucursal::all();
        $servicios = Service::all();
        $rangos = array();

        foreach ($servicios as $servicio) {
            foreach ($sucursales as $sucursal) {
                $rangos[$sucursal->id . '-' . $servicio->id] = $this->getDataRango($sucursal->id, $servicio->id, 1);
            }
        }

        return response()->json($rangos, 200);
    }

    public function ejecutarOrden($orden_id)
    {
        $orden = Orden::find($orden_id);

        $orden->ejecutado = true;

        if ($orden->save()) {
            return response()->json(true, 200);
        }

        return response()->json(false, 500);
    }

    public function totalesServicio($ejecutado = 0)
    {
        $servicios = Service::all();
        $totalesServicio = array();

        foreach($servicios as $servicio){
            $ordenes = Orden::where('ejecutado', $ejecutado)
            ->where('services_id', $servicio->id)
            ->get();

            $rangos = array(
                '0-10' => 0,
                '11-30' => 0,
                '31-90' => 0,
                '91-180' => 0,
                '>180' => 0
            );

            foreach ($ordenes as $orden) {
                $dias = Carbon::now()->diffInDays($orden->fecha);

                if ($dias < 10) {
                    $rangos['0-10']++;
                } elseif ($dias > 10 && $dias <= 30) {
                    $rangos['11-30']++;
                } elseif ($dias > 30 && $dias <= 90) {
                    $rangos['31-90']++;
                } elseif ($dias > 91 && $dias <= 180) {
                    $rangos['91-180']++;
                } else {
                    $rangos['>180']++;
                }
            }

            $totalesServicio[$servicio->id] = $rangos;
        }

        return $totalesServicio;
    }
}
