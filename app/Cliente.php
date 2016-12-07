<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";

    protected $fillable = ['id','rfc','nombre_comercial','telefono','email','calle','numero','colonia','codigo_postal','municipio','estado','pais','activo'];

    public function ventas()
    {
        return $this->hasMany('App\Venta');
    }
}
