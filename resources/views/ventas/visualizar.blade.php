	@extends('layouts.app')
	@section('title','Visualización venta')
	@section('content')

    <div class="container">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
		<ol class="breadcrumb">
			<li class="active"><h4>Visualización de venta</h4></li>
		</ol>
    {!! Form::open() !!}
		<div class="form-group col-lg-6">
			{!! Form::label('facturada','Facturada') !!}
			@if($venta->facturada=='false')
				{!! Form::text('facturada', 'Facturada', ['class' => 'form-control', 'required', 'readonly' => 'readonly', ]) !!}
			@else
				{!! Form::text('facturada', 'No-facturada', ['class' => 'form-control', 'required', 'readonly' => 'readonly', ]) !!}
			@endif

			{!! Form::label('id_cliente','Clientes') !!}
			{!! Form::text('id_cliente', $venta->nombre_cliente, ['class' => 'form-control', 'required', 'readonly' => 'readonly', ]) !!}

			{!! Form::label('notas','Notas') !!}
			{!! Form::text('notas', $venta->notas, ['class' => 'form-control', 'placeholder' => '', 'readonly' => 'readonly']) !!}
		</div>

		<div class="form-group col-lg-6">
			{!! Form::label('numero_factura','Número de factura') !!}
			{!! Form::text('numero_factura', $venta->numero_factura, ['class' => 'form-control', 'required', 'placeholder' => 'Número de factura', 'readonly' => 'readonly']) !!}

			{!! Form::label('created_at','Fecha de venta') !!}
			{!! Form::text('created_at', $venta->created_at, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			{!! Form::label('referencia','Referencias') !!}
			{!! Form::text('referencia', $venta->referencia, ['class' => 'form-control', 'placeholder' => 'Referencias', 'readonly' => 'readonly']) !!}
		</div>

		<h4>Resumen de productos</h4>

		<table id="table" class="display" cellspacing="0" width="100%">
		<thead>
	            <tr>
	            	<th>Id</th>
					<th>Nombre</th>
					<th>Costo</th>
					<th>Cantidad</th>
					<th>Subtotal $</th>
					<th>Descuento %</th>
					<th>Descuento $</th>
					<th>Iva $</th>
					<th>Ieps $</th>
					<th>Total $</th>
	            </tr>
	        </thead>
	        <tfoot>
	            <tr>
	            	<th>Id</th>
					<th>Nombre</th>
					<th>Costo</th>
					<th>Cantidad</th>
					<th>Subtotal $</th>
					<th>Descuento %</th>
					<th>Descuento $</th>
					<th>Iva $</th>
					<th>Ieps $</th>
					<th>Total $</th>
	            </tr>
	        </tfoot>
	        <tbody>
	           @foreach($detalles as $detalle)
					<tr>
					<td> {{ $detalle->id_producto }} </td>
					<td> {{ $detalle->nombre_producto }} </td>
					<td> {{ $detalle->precio }} </td>
					<td> {{ $detalle->cantidad }} </td>
					<td> {{ $detalle->subtotal }} </td>
					<td> {{ $detalle->descuento_porcentaje }} </td>
					<td> {{ $detalle->descuento_pesos }} </td>
					<td> {{ $detalle->iva }} </td>
					<td> {{ $detalle->ieps }} </td>
					<td> {{ $detalle->total }} </td>
					</tr>
					@endforeach
						<td> Totales: </td>
						<td></td>
						<td></td>
						<td> {{ $resumen->cantidad }} </td>
						<td> {{ $resumen->subtotal }} </td>
						<td> {{ $resumen->descuento_porcentaje }} </td>
						<td> {{ $resumen->descuento_pesos }} </td>
						<td> {{ $resumen->iva }} </td>
						<td> {{ $resumen->ieps }} </td>
						<td> {{ $resumen->total }} </td>
				</tbody>
	    </table>	
	    <div class="form-group">
			<a href="{{ route('ventas.index') }}" class="btn btn-info">Volver</a><hr>
		</div>
	{!! Form::close() !!}
    </div>
	@stop    
