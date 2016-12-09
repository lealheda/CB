<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Venta;
use App\Venta_detalle;
use App\Cliente;
use App\Producto;
use Laracasts\Flash\Flash;
use Dompdf\Dompdf;
use App;
use Illuminate\Support\Facades\Input;
use Auth;

class VentasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        $fecha = date('Y-m-d');
        $clientes = Cliente::Where('activo', 1)->orderBy('nombre_comercial')->get();
        $productos = Producto::Where('activo', 1)->get();
    	return view('ventas.registro')->with('fecha_venta',$fecha)->with('clientes',$clientes)->with('productos',$productos);
    }

	public function index(){
		$ventas = Venta::where('activo','=', 1)->get();
    	return view('ventas.index')->with('ventas',$ventas);
    }    

    public function view($id){
        $venta = Venta::find($id);
    	return view('ventas.view')->with('venta',$venta);
    }

     public function pdf($id){
        $venta = venta::find($id);
        $view = \View::make('ventas.pdf', compact('venta'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $view->stream($venta->id);
        //return $pdf->download($venta->id+'.pdf');
    }

      public function store(Request $request){
        /* Encabezado de venta */
        $result = $request::all();
        $venta = new Venta($result);
        $venta->cliente_id = Input::get('comboboxcliente');
        $codigos = Input::get('codigo');
        $cantidad = Input::get('cantidad');
        $precio = Input::get('precio');
        $importe = Input::get('importe');
        $descuento = Input::get('descuento');
        $impuestos = Input::get('impuestos');
        $totales = Input::get('totales');
        $total_productos = 0; $total_descuento_porcentaje=0; $total_descuento_pesos=0;
        $subtotal=0; $total_iva=0; $total_ieps=0; $total=0;
        $posicion = 0;
        foreach ($codigos as $codigo) {
            $producto = Producto::find($codigo);
            $total_productos += $cantidad[$posicion];
            $total_descuento_porcentaje += $descuento[$posicion];
            $total_descuento_pesos += $importe[$posicion] * ($descuento[$posicion]/100);
            $subtotal += $importe[$posicion];
            $total_iva += $importe[$posicion] * ($producto->iva/100);
            $total_ieps += $importe[$posicion] * ($producto->ieps/100);
            $total += $totales[$posicion];
            $posicion++;
        }
        $venta->total_productos = $total_productos;
        $venta->descuento_pesos = $total_descuento_pesos;
        $venta->descuento_porcentaje = $total_descuento_porcentaje;
        $venta->subtotal = $subtotal;
        $venta->iva = $total_iva;
        $venta->ieps = $total_ieps;
        $venta->total=$total;
        $venta->activo = true;
        $venta->save();
        /* Fin encabezado de venta */ 
        
        /* Detalles de la venta*/
        $posicion=0;
        foreach ($codigos as $codigo) {
            $venta_detalle = new venta_detalle();
            $producto = Producto::find($codigo);
            $venta_detalle->producto_id = $producto->id;
            $venta_detalle->venta_id = $venta->id;
            $venta_detalle->precio = $producto->precio;
            $venta_detalle->cantidad = $cantidad[$posicion];
            $venta_detalle->descuento_porcentaje = $descuento[$posicion];
            $venta_detalle->descuento_pesos = $importe[$posicion] * ($descuento[$posicion]/100);
            $venta_detalle->subtotal = $importe[$posicion];
            $venta_detalle->iva = $importe[$posicion] * ($producto->iva/100);
            $venta_detalle->ieps = $importe[$posicion] * ($producto->ieps/100);
            $venta_detalle->total = $totales[$posicion];
            $posicion++;
            $venta_detalle->save();
        }
            $cliente = Cliente::find($venta->cliente_id);
	    	Flash::success(' Su venta al cliente ' . $cliente->nombre_comercial .' se ha registrado con exito !');
	    	return redirect()->route('ventas.index');
    }

    public function destroy($id){
    	$venta = venta::find($id);
        $venta->activo=0;
        $venta->save();
        Flash::error('¡ Su venta ha sido eliminado con exito !');
            return redirect()->route('ventas.index');    
        }
}
