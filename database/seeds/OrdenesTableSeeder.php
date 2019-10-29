<?php

use Carbon\Carbon;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obes')->insert([
            'no_serie' => Str::random(10),
            'fecha' => Carbon::now()->format('Y-m-d H:i:s'),
            'cliente' => Str::random(10),
            'dir' => Str::random(50),
            'no_serie' => true,
            'fecha_ejecucion' => Carbon::now()->format('Y-m-d H:i:s'),
            'sucursales_id' => factory('App\Sucursal')->create()->id,
            'services_id' => factory('App\Service')->create()->id,
        ]);
    }
}
