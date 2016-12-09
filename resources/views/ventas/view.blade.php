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
		 <label>Cliente: </label>
			<select id="comboboxcliente" name="comboboxcliente" class="selectpicker" data-live-search="true" data-width="75%">
                <option value="{{$venta->cliente->nombre_comercial}}"'>{{$venta->cliente->nombre_comercial}}</option>
            </select>			
		</div>

		<div class="form-group col-lg-6">

			{!! Form::label('created_at','Fecha de venta') !!}
			{!! Form::text('created_at', $venta->created_at, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			{!! Form::label('notas','Notas') !!}
			{!! Form::text('notas', $venta->notas, ['class' => 'form-control', 'placeholder' => 'Ingrese alguna nota', 'readonly' => 'readonly']) !!}
		</div>

		<h4>Resumen de productos</h4>
		<table class="table">
            <tr>
                <th width="3%">Código:</th>
                <th width="25%">Descripción:</th>
                <th width="10%">Precio:</th>
                <th width="5%">Cantidad:</th>
                <th width="8%">Importe:</th>
                <th width="5%">Descuento %:</th>
                <th width="8%">Descuento $:</th>
                <th width="8%">Iva:</th>
                <th width="8%">Ieps:</th>
                <th width="12%">Total:</th>
                <th></th>
            </tr>
            @foreach($venta->venta_detalle as $detalle)
            <tr>
				<td> {!! Form::text('codigo', $detalle->producto_id, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!} </td>
				<td> {!! Form::text('descripcion', $detalle->producto->nombre, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!} </td>
				<td> {!! Form::text('precio', $detalle->precio, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!} </td>
				<td> {!! Form::text('cantidad', $detalle->cantidad, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!} </td>
				<td> {!! Form::text('subtotal', $detalle->subtotal, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!} </td>
				<td> {!! Form::text('descuento_porcentaje', $detalle->descuento_porcentaje, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!} </td>
				<td> {!! Form::text('descuento_pesos', $detalle->descuento_pesos, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!} </td>
				<td> {!! Form::text('iva', $detalle->iva, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!} </td>
				<td> {!! Form::text('ieps', $detalle->ieps, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!} </td>
				<td> {!! Form::text('total', $detalle->total, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!} </td>
			</tr>
            @endforeach
        </table>
        	<h4>Resumen de venta</h4>
			<div class="form-group col-lg-12">
			{!! Form::label('total_productos','Total de productos') !!}
			{!! Form::text('total_productos', $venta->total_productos, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			{!! Form::label('subtotal','Subtotal') !!}
			{!! Form::text('subtotal', $venta->subtotal ,['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			{!! Form::label('descuento_porcentaje','Descuento %') !!}
			{!! Form::text('descuento_porcentaje', $venta->descuento_porcentaje, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			{!! Form::label('descuento_pesos','Descuento $') !!}
			{!! Form::text('descuento_pesos', $venta->descuento_pesos, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			{!! Form::label('iva','Iva $') !!}
			{!! Form::text('iva', $venta->iva, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			{!! Form::label('ieps','Ieps $') !!}
			{!! Form::text('ieps', $venta->ieps, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			{!! Form::label('total','Total $') !!}
			{!! Form::text('total', $venta->total, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			</div>
	    <div class="form-group">
			<a href="{{ route('ventas.index') }}" class="btn btn-info">Volver</a><hr>
		</div>
	{!! Form::close() !!}
    </div>
	@stop    
