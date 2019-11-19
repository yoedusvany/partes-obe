<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::apiResource('services', 'ServicesController');
Route::apiResource('sucursales', 'SucursalController');
Route::apiResource('ordenes', 'OrdenController');

Route::get('getAllRangos', 'OrdenController@getAllRangos');
Route::get('getAllRangosEjecutados', 'OrdenController@getAllRangosEjecutados');
Route::get('totalesServicio/{ejecutado?}', 'OrdenController@totalesServicio');
Route::get('ejecutarOrden/{ordenId}', 'OrdenController@ejecutarOrden');
