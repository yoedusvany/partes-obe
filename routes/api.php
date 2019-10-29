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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('services', 'ServicesController');
Route::resource('sucursales', 'SucursalController');
Route::resource('ordenes', 'OrdenController');

Route::get('getAllRangos', 'OrdenController@getAllRangos');
Route::get('ejecutarOrden/{ordenId}', 'OrdenController@ejecutarOrden');
