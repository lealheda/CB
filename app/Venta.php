<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "ventas";

    protected $fillable = ['id','cliente_id','notas','total_productos','descuento_porcentaje','descuento_pesos','subtotal','iva','ieps','total','activo','created_at'];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function venta_detalle()
    {
        return $this->hasMany('App\Venta_detalle');
    }

}
