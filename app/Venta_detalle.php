<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta_detalle extends Model
{
    protected $table = "ventas_detalle";

    protected $fillable = ['id','producto_id','venta_id','nombre_producto','descripcion','precio','cantidad','descuento_porcentaje','descuento_pesos','subtotal','iva','ieps','total','created_at'];

    public function producto()
    {
        return $this->belongsTo('App\Producto');
    }

    public function venta()
    {
        return $this->belongsTo('App\Venta');
    }

}
