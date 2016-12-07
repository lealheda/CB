<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Cliente;
use App\User;
use Laracasts\Flash\Flash;
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
    	return view('clientes.editar')->with('cliente',$cliente);
    }

    public function update(Request $request, $id){
        $rfc = Request::get('rfc');
        if($this->validaRfc($rfc)==0){
            $error="RFC No valido, Ejemplo: LEHD920117XXXX";
            return view('clientes.editar')->with('cliente',$cliente)->withErrors($error);
        }
    	$cliente = Cliente::find($id);
    	$rules = array(
            'nombre_comercial'       => 'required',
            'rfc'       => 'required',
            'telefono'       => 'required',
            'email'      => 'required|email',
            'calle'      => 'required',
            'numero'      => 'required',
            'colonia'      => 'required',
            'codigo_postal'      => 'required|numeric|max:99999',
            'municipio'      => 'required',
            'estado'      => 'required',
            'pais'      => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
        	return view('clientes.editar')->with('cliente',$cliente)->withErrors($validator);
        } else {
        	$datos = Request::all();
        	$cliente->update(Request::all());
	    	$cliente->save();
	    	Flash::success('Cliente ' . $cliente->nombre_comercial .' se ha actualizado con exito');
	    	return redirect()->route('clientes.index');
        }
    }

    public function store(Request $request){
        $rfc = Request::get('rfc');
        if($this->validaRfc($rfc)==0){
            $error="RFC No valido, Ejemplo: LEHD920117XXXX";
            return view('clientes.registro')->withErrors($error);
        }
    	$rules = array(
            'nombre_comercial'       => 'required',
            'rfc'       => 'required',
            'telefono'       => 'required',
            'email'      => 'required|email',
            'calle'      => 'required',
            'numero'      => 'required',
            'colonia'      => 'required',
            'codigo_postal'      => 'required|numeric|max:99999',
            'municipio'      => 'required',
            'estado'      => 'required',
            'pais'      => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
        	return view('clientes.registro')->withErrors($validator);
        } else {
            $cliente = new cliente(Request::all());
            $cliente -> activo = 1;
            $cliente->save();
            Flash::success('Cliente ' . $cliente->nombre_comercial .' se ha registrado con exito');
	    	return redirect()->route('clientes.index');
        }
    }

    public function destroy($id){
    	$cliente = cliente::find($id);
    	$cliente->activo=0;
    	$cliente->save();
    	Flash::error('¡Cliente ' . $cliente->nombre_comercial .' ha sido desactivado con exito!');
    	return redirect()->route('clientes.index');
    }

    public function validaRfc($rfc){
        $regex = '/^[A-Z]{4}([0-9]{2})(1[0-2]|0[1-9])([0-3][0-9])([ -]?)([A-Z0-9]{4})$/';
        return preg_match($regex, $rfc);
    }


}
