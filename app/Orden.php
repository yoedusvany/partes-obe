<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'ordenes';

    protected $fillable = ['no_serie','cliente','dir', 'ejecutado','fecha','fecha_ejecucion','sucursales_id','services_id'];

    public function sucursal()
    {
        return $this->belongsTo('App\Sucursal');
    }

    public function servicio()
    {
        return $this->belongsTo('App\Service', 'services_id');
    }
}
