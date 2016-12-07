<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
     protected $table = "productos";

    protected $fillable = ['id','nombre','descripcion','precio','iva','ieps','descuento_maximo','categoria','unidades','activo'];

    public function venta_detalle()
    {
        return $this->hasMany('App\Venta_detalle');
    }

}
