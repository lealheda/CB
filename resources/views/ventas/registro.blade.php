	@extends('layouts.app')
	@section('title','Nueva venta')
	@section('content')

    <div class="container">
    @if (!empty($error))
    <div class="alert alert-danger">
        <ul>
                <li>{{ $error }}</li>
        </ul>
    </div>
	@endif
		<ol class="breadcrumb">
			<li class="active"><h4>Nueva venta</h4></li>
		</ol>
    {!! Form::open(['route' => 'ventas.prestore', 'method'=> 'POST']) !!}
		<div class="form-group col-lg-6">
			{!! Form::label('created_at','Fecha de venta') !!}
			{!! Form::text('created_at', $fecha_venta, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}
		
			{!! Form::label('id_cliente','Clientes') !!}
			{!! Form::select('id_cliente', $clientes, null, ['class' => 'form-control', 'required']) !!}
		</div>

		<div class="form-group col-lg-6">
			{!! Form::label('notas','Notas') !!}
			{!! Form::text('notas', null, ['class' => 'form-control', 'placeholder' => 'Ingrese alguna nota']) !!}

			{!! Form::label('referencia','Referencias') !!}
			{!! Form::text('referencia', null, ['class' => 'form-control', 'placeholder' => 'Referencias']) !!}
		</div>
		<h4>Catalogo de productos</h4>

		<table id="table" class="display" cellspacing="0" width="100%">
		<thead>
	            <tr>
	            	<th>Id</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Precio $</th>
					<th>Cantidad</th>
					<th>Iva %</th>
					<th>Ieps %</th>
					<th>Descuento %</th>
	            </tr>
	        </thead>
	        <tfoot>
	            <tr>
	            	<th>Id</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Precio $</th>
					<th>Cantidad</th>
					<th>Iva %</th>
					<th>Ieps %</th>
					<th>Descuento %</th>
	            </tr>
	        </tfoot>
	        <tbody>
	           @foreach($productos as $producto)
					<tr>
						<td> {{ Form::text('id_producto[]', $producto->id, ['class' => 'form-control', 'required', 'readonly' => 'readonly', 'min' => '0.01', 'step' => '0.01' ]) }} </td>
						<td> {{ $producto->nombre }} </td>
						<td> {{ $producto->descripcion }} </td>
						<td> {{ $producto->precio }} </td>
						<td> 
						{!! Form::number('cantidad[]', 0, ['class' => 'form-control', 'required']) !!} 
						</td>
						<td> {{ $producto->iva }} </td>
						<td> {{ $producto->ieps }} </td>
						<td> 
						{!! Form::number('descuento[]', 0, ['class' => 'form-control', 'required', 'min' => '0.00', 'step' => 'any']) !!} 
						</td>
					</tr>
					@endforeach
				</tbody>
	    </table>	

	    <div class="form-group">
			{!! Form::submit('Registrar', ['class' => 'btn btn-primary', 'onClick'=>'return validateCantidad()']) !!}
		</div>
	{!! Form::close() !!}
    </div>
	@stop    
