<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Producto;
use App\User;
use App\Inventario;
use Laracasts\Flash\Flash;
use Auth;

class ProductosController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
    	return view('productos.registro');
    }

	public function index(){
		$productos = Producto::where('activo','=', 1)->get();
    	return view('productos.index')->with('productos',$productos);
    }    

    public function edit($id){
    	$producto = Producto::find($id);
    	return view('productos.editar')->with('producto',$producto);
    }

    public function update(Request $request, $id){
    	$producto = Producto::find($id);
    	$rules = array(
            'nombre'       => 'required',
            'descripcion'       => 'required',
            'precio'       => 'required|numeric',
            'iva'      => 'required|numeric',
            'ieps'      => 'required|numeric',
            'descuento_maximo'      => 'required|numeric|max:100',
            'categoria'      => 'required',
            'unidades'      => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
        	return view('productos.editar')->with('producto',$producto)->withErrors($validator);
        } else {
        	$producto->update(Request::all());
	    	Flash::success('Producto ' . $producto->nombre .' se ha actualizado con exito');
	    	return redirect()->route('productos.index');
        }
    }

    public function store(Request $request){
    	$rules = array(
            'nombre'       => 'required',
            'descripcion'       => 'required',
            'precio'       => 'required|numeric',
            'iva'      => 'required|numeric|max:100',
            'ieps'      => 'required|numeric|max:100',
            'descuento_maximo'      => 'required|numeric|max:100',
            'categoria'      => 'required',
            'unidades'      => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
        	return view('productos.registro')->withErrors($validator);
        } else {
            $producto = new Producto(Request::all());
            $producto -> activo = 1;
            $producto->save();
	    	Flash::success('Producto ' . $producto->nombre .' se ha registrado con exito');
	    	return redirect()->route('productos.index');
        }
    }

    public function destroy($id){
    	$producto = producto::find($id);
      	$producto->activo=0;
       	$producto->save();
       	Flash::error('¡Producto ' . $producto->nombre .' ha sido eliminado con exito!');
        	return redirect()->route('productos.index');
        }
}
