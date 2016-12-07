<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Cliente;
use App\User;
use Auth;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
    	return view('clientes.registro');
    }

	public function index(){
		$clientes = Cliente::where('activo','=', 1)->get();
    	return view('clientes.index')->with('clientes',$clientes);
    }    

    public function edit($id){
    	$cliente = Cliente::find($id);
    	return view('layouts.clientes.editar')->with('cliente',$cliente);
    }

    public function update(Request $request, $id){
    	$cliente = Cliente::find($id);
    	$rules = array(
            'nombre'       => 'required',
            'rfc'       => 'required',
            'telefono'       => 'required',
            'correo_electronico'      => 'required|email',
            'calle'      => 'required',
            'numero'      => 'required',
            'colonia'      => 'required',
            'codigo_postal'      => 'required|numeric|max:99999',
            'municipio'      => 'required',
            'estado'      => 'required',
            'pais'      => 'required',
            'limite_credito'      => 'required|numeric'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
        	return view('layouts.clientes.editar')->with('cliente',$cliente)->withErrors($validator);
        } else {
        	$datos = Request::all();
        	$cliente->update(Request::all());
        	$user = Auth::user();
        	$cliente->id_empleado_creo=$user->id_empleado;
	    	$cliente->save();
	    	Flash::success('Cliente ' . $cliente->nombre .' se ha actualizado con exito');
	    	return redirect()->route('clientes.index');
        }
    }

    public function store(Request $request){
    	$rules = array(
            'nombre'       => 'required',
            'rfc'       => 'required',
            'telefono'       => 'required',
            'correo_electronico'      => 'required|email',
            'calle'      => 'required',
            'numero'      => 'required',
            'colonia'      => 'required',
            'codigo_postal'      => 'required|numeric|max:99999',
            'municipio'      => 'required',
            'estado'      => 'required',
            'pais'      => 'required',
            'limite_credito'      => 'required|numeric'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
        	return view('layouts.clientes.registro')->withErrors($validator);
        } else {
            $cliente = new cliente(Request::all());
            $cliente -> activo = 1;
            $cliente->save();
	    	return redirect()->route('clientes.index');
        }
    }

    public function destroy($id){
    	$cliente = cliente::find($id);
    	$cliente->activo=0;
        $user = Auth::user();
        $cliente -> id_empleado_creo  = $user->id_empleado;
    	$cliente->save();
    	Flash::error('¡Cliente ' . $cliente->nombre .' ha sido eliminado con exito!');
    	return redirect()->route('clientes.index');
    }

}
