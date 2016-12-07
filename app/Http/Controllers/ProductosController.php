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
    	return view('layouts.productos.registro');
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
        	return view('layouts.productos.editar')->with('producto',$producto)->withErrors($validator);
        } else {
        	$datos = Request::all();
        	$producto->update(Request::all());
        	$user = Auth::user();
        	$producto->id_empleado_creo=$user->id_empleado;
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
            'unidades'      => 'required',
            'costo'      => 'required|numeric',
            'minimo_inventario'      => 'required|numeric'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
        	return view('layouts.productos.registro')->withErrors($validator);
        } else {
            $producto = new Producto(Request::all());
            $producto -> activo = 1;
            $user = Auth::user();
            $producto -> id_empleado_creo  = $user->id_empleado;
            $producto->save();
            $inventario = new Inventario();
            $inventario->id_producto = $producto->id;
            $inventario->cantidad = 0;
            $inventario->activo = true;
            $inventario->save();
	    	Flash::success('Producto ' . $producto->nombre .' se ha registrado con exito');
	    	return redirect()->route('productos.index');
        }
    }

    public function destroy($id){
    	$producto = producto::find($id);
        $inventario = Inventario::where('id_producto', '=', $producto->id)->first();
        if($inventario->cantidad!=0){
            Flash::error('¡ El Producto ' . $producto->nombre .' No se puede eliminar por existencias !');
            return redirect()->route('productos.index');    
        }
        else{
            $inventario->activo = 0;
            $inventario->save();
        	$producto->activo=0;
            $user = Auth::user();
            $producto -> id_empleado_creo  = $user->id_empleado;
        	$producto->save();
        	Flash::success('¡Producto ' . $producto->nombre .' ha sido eliminado con exito!');
        	return redirect()->route('productos.index');
        }
    }
}
