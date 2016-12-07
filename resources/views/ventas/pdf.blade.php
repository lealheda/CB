@extends('layouts.pdf.main')
@section('content')
<div class="container">
<div id="details" class="clearfix">
        <div id="client">
          <div class="to">Cliente:</div>
          <h2 class="name">{{$cliente->nombre}}</h2>
          <div class="to">RFC:</div>
          <h2 class="name">{{$cliente->rfc}}</h2>
          <div class="to">Dirección</div>
          <div class="address">{{$cliente->calle}} #{{$cliente->numero}} {{$cliente->colonia}} {{$cliente->codigo_postal}}</div>
          <div class="address">{{$cliente->municipio}} {{$cliente->estado}} {{$cliente->pais}}</div>
          <div class="to">Correo electrónico</div>
          <div class="email"><a href="mailto:lealheda@gmail.com">{{$cliente->correo_electronico}}</a></div>
        </div>
        <div id="invoice">
          <h1>Venta</h1>
          <div class="date">Fecha de operación: {{$venta->created_at}}</div>
        </div>
      </div>
<table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPCION</th>
            <th class="unit">PRECIO UNIDAD</th>
            <th class="qty">CANTIDAD</th>
            <th class="des">DESCUENTOS $</th>
            <th class="impuesto">IMPUESTOS $</th>
            <th class="total">TOTAL $</th>
          </tr>
        </thead>
        <tbody>
        @foreach($detalles as $detalle)
          <tr>
            <td class="no">{{$detalle->id}}</td>
            <td class="desc"><h3>{{$detalle->nombre_producto}}</h3>{{$detalle->descripcion}}</td>
            <td class="unit">{{$detalle->precio}}</td>
            <td class="qty">{{$detalle->cantidad}}</td>
            <td class="qty">{{$detalle->descuento_pesos}}</td>
            <td class="qty">{{$detalle->iva + $detalle->ieps}}</td>
            <td class="total">{{$detalle->total}}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3"></td>
            <td colspan="3">Descuentos</td>
            <td>${{$resumen->descuento_pesos}}</td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td colspan="3">Subtotal</td>
            <td>${{$resumen->subtotal}}</td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td colspan="3">Impuestos</td>
            <td>${{$resumen->iva + $resumen->ieps}}</td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td colspan="3">Total</td>
            <td>${{$resumen->total}}</td>
          </tr>
        </tfoot>
      </table>
      </div>
</div>
@endsection