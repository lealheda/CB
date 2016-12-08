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

    private function create_error($error){
        $fecha = date('Y-m-d');
        $clientes = Cliente::where('activo', true)->orderBy('nombre')->lists('nombre', 'id');
        $productos = Producto::all();
        return view('layouts.ventas.registro')->with('fecha_venta',$fecha)->with('clientes',$clientes)->with('productos',$productos)->with('error',$error);
    }

	public function index(){
		$ventas = venta::where('activo','=', 1)->get();
        foreach ($ventas as $venta){
            $cliente = Cliente::find($venta->id_cliente);
            $venta->nombre_cliente = $cliente->nombre;
        }
    	return view('ventas.index')->with('ventas',$ventas);
    }    

    public function view($id){
    	$venta = venta::find($id);
        $cliente = cliente::find($venta->id_cliente);
        $venta->nombre_cliente = $cliente->nombre;
        $detalles = venta_detalle::where('id_venta', '=', $venta->id)->get();
        $resumen = new Resumen();
        foreach ($detalles as $detalle) {
            $producto = Producto::find($detalle->id_producto);
            $detalle->nombre_producto = $producto->nombre;
            $resumen->cantidad += $detalle->cantidad;
            $resumen->descuento_porcentaje += $detalle->descuento_porcentaje;
            $resumen->descuento_pesos += $detalle->descuento_pesos;
            $resumen->subtotal += $detalle->subtotal;
            $resumen->iva += $detalle->iva;
            $resumen->ieps += $detalle->ieps;
            $resumen->total += $detalle->total;
        }        
    	return view('layouts.ventas.visualizar')->with('venta',$venta)->with('detalles',$detalles)->with('resumen',$resumen);
    }

     public function pdf($id){
        $venta = venta::find($id);
        $cliente = cliente::find($venta->id_cliente);
        $detalles = venta_detalle::where('id_venta', '=', $venta->id)->get();
        $resumen = new Resumen();
        foreach ($detalles as $detalle) {
            $producto = Producto::find($detalle->id_producto);
            $detalle->nombre_producto = $producto->nombre;
            $detalle->descripcion = $producto->descripcion;
            $resumen->cantidad += $detalle->cantidad;
            $resumen->descuento_porcentaje += $detalle->descuento_porcentaje;
            $resumen->descuento_pesos += $detalle->descuento_pesos;
            $resumen->subtotal += $detalle->subtotal;
            $resumen->iva += $detalle->iva;
            $resumen->ieps += $detalle->ieps;
            $resumen->total += $detalle->total;
        }  
        //dd($resumen);
        $view = \View::make('layouts.ventas.pdf', compact('cliente','venta','detalles','resumen'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream($venta->id);
        //return $pdf->download($venta->id+'.pdf');
    }

    /*Pendiente de realizar para facturar*/
    public function update(Request $request, $id){
        dd("En proceso de facturación");
        $ldate = date('Y-m-d H:i:s');
        $venta = venta::find($id);
        if($venta->surtida==true){
            Flash::error('¡ Su venta no puede ser surtida por que ya fue surtida !');
            return redirect()->route('ventas.index');
        }else{
            $venta->surtida = true;
            $venta->fecha_surtida = $ldate;
            $user = Auth::user();
            $venta->id_empleado_creo = $user->id_empleado;
            $venta->save();
            $detalles = venta_detalle::where('id_venta','=',$venta->id)->get();
            foreach ($detalles as $detalle) {
                $inventario = Inventario::where('id_producto','=',$detalle->id_producto)->first();
                $inventario->cantidad += $detalle->cantidad;
                $inventario->save();
            }
            Flash::success('¡ Su venta ha sido surtida con exito !');
            return redirect()->route('ventas.index');
        }
    }

    public function prestore(Request $request){
        $result = $request::all();
        //dd($result);
        $id_productos = Input::get('id_producto');
        $cantidad = Input::get('cantidad');
        $descuento = Input::get('descuento');
        $all_productos = Producto::findMany($id_productos);
        $detalle = new venta_detalle();
        $resumen = new Resumen();
        $posicion = 0; 
        $detalles = array();
        $resumen_productos = array();
        foreach ($all_productos as $producto){
            if($cantidad[$posicion]>0){
                $detalle = new venta_detalle();
                $detalle->id_producto = $producto->id;
                $inventario = Inventario::where('id_producto','=',$producto->id)->first();
                if($cantidad[$posicion]>$inventario->cantidad){
                    return $this->create_error("Error, solo cuenta en inventario la cantidad de ".$inventario->cantidad." del producto ".$producto->nombre);
                }
                else{
                    $detalle->nombre_producto = $producto->nombre;
                    $detalle->precio = $producto->precio;
                    $detalle->cantidad = $cantidad[$posicion];
                    $detalle->subtotal = round($producto->precio * $cantidad[$posicion],2); 
                    $detalle->descuento_porcentaje = $descuento[$posicion];
                    $detalle->descuento_pesos = round($detalle->subtotal * ($descuento[$posicion] / 100),2); 
                    $detalle->iva = round($detalle->subtotal * ($producto->iva / 100),2);
                    $detalle->ieps = round($detalle->subtotal * ($producto->ieps / 100),2);
                    $detalle->total = round($detalle->subtotal - $detalle->descuento_pesos + $detalle->iva + $detalle->ieps,2);
                    $resumen->cantidad += $detalle->cantidad;
                    $resumen->descuento_porcentaje += $detalle->descuento_porcentaje;
                    $resumen->descuento_pesos += $detalle->descuento_pesos;
                    $resumen->subtotal += $detalle->subtotal;
                    $resumen->iva += $detalle->iva;
                    $resumen->ieps += $detalle->ieps;
                    $resumen->total += $detalle->total;
                    $detalles[] = $detalle;
                }
                $posicion++;
                }
        }
        $datos_venta = new venta($result);
        $fecha = date('Y-m-d H:i:s');
        //dd($resumen);
        $cliente = Cliente::find($datos_venta->id_cliente);
        return view('layouts.ventas.resumen')->with('fecha_venta',$fecha)->with('datos_venta',$datos_venta)->with('cliente',$cliente)->with('detalles',$detalles)->with('resumen',$resumen);
    }

    public function store(Request $request){
        /* Encabezado de venta */
        $result = $request::all();
        $venta = new Venta($result);
        $venta->id_cliente = Input::get('comboboxcliente');
        //dd($venta);
        $codigos = Input::get('codigo');
        $cantidad = Input::get('cantidad');
        $i = 0;
        $venta_detalle = new venta_detalle();
        dd($venta_detalle);
        foreach ($codigos as $codigo) {
            dd($cantidad[$i]);
            $i++;
        }
        dd($cantidad);
        $venta->activo = true;
        $venta->total_productos = Input::get('final_cantidad');
        $venta->descuento_porcentaje = Input::get('final_porcentaje');
        $venta->descuento_pesos = Input::get('final_pesos');
        $venta->subtotal = Input::get('final_subtotal');
        $venta->iva = Input::get('final_iva');
        $venta->ieps = Input::get('final_ieps');
        $venta->total = Input::get('final_total');
        $venta->tipo_pago = "Contado";
        $venta->save();
        /* Fin encabezado de venta */ 
        //dd($result);
        /* Detalles */
        $id_venta = $venta->id;
        $id_productos = Input::get('id_producto');
        $precio = Input::get('precio');
        $cantidad = Input::get('cantidad');
        $descuento_porcentaje = Input::get('descuento_porcentaje');
        $descuento_pesos = Input::get('descuento_pesos');
        $subtotal = Input::get('subtotal');
        $iva = Input::get('iva');
        $ieps = Input::get('ieps');
        $total = Input::get('total');
        $posicion=0;
        foreach ($id_productos as $producto) {
            //dd($producto);
            $venta_detalle = new venta_detalle();
            $venta_detalle->id_producto = $producto;
            $venta_detalle->id_venta = $id_venta;
            $venta_detalle->precio = $precio[$posicion];
            $venta_detalle->cantidad = $cantidad[$posicion];
            $venta_detalle->descuento_porcentaje = $descuento_porcentaje[$posicion];
            $venta_detalle->descuento_pesos = $descuento_pesos[$posicion];
            $venta_detalle->subtotal = $subtotal[$posicion];
            $venta_detalle->iva = $iva[$posicion];
            $venta_detalle->ieps = $ieps[$posicion];
            $venta_detalle->total = $total[$posicion];
            $posicion++;
            //dd($venta_detalle);
            $venta_detalle->save();
            $inventario = Inventario::where('id_producto','=',$venta_detalle->id_producto)->first();
            $inventario->cantidad-=$venta_detalle->cantidad;
            $inventario->save();
        }
	    	Flash::success(' Su venta al cliente ' . $id_cliente->nombre .' se ha registrado con exito !');
	    	return redirect()->route('ventas.index');
    }

    public function destroy($id){
        /*
         * Falta cancelar notas facturadas.
        */
    	$venta = venta::find($id);
        if($venta->factura==true){
            dd("En proceso de eliminar cuando estan facturadas");
        }
        else{
            $detalles = Venta_detalle::where('id_venta','=',$id)->get();
            foreach ($detalles as $detalle) {
                $inventario = Inventario::Where('id_producto','=',$detalle->id_producto)->first();
                $inventario->cantidad += $detalle->cantidad;
                $inventario->save();
            }
            $venta->activo=0;
            $user = Auth::user();
            $venta -> id_empleado_creo  = $user->id_empleado;
            $venta->save();
            Flash::error('¡ Su venta ha sido eliminado con exito !');
            return redirect()->route('ventas.index');    
        }
    }
}
