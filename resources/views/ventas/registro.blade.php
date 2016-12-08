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
    {!! Form::open(['route' => 'ventas.store', 'method'=> 'POST', 'id'=>'valida_productos']) !!}
		<div class="form-group col-lg-6">
		 <label>Cliente: </label>
			<select id="comboboxcliente" name="comboboxcliente" class="selectpicker" data-live-search="true" data-width="75%">
                @foreach($clientes as $cliente)
                <option value="{{$cliente->id}}" data-subtext='{{$cliente->id}}'>{{$cliente->nombre_comercial}}</option>
                @endforeach
            </select>			
		</div>

		<div class="form-group col-lg-6">

			{!! Form::label('created_at','Fecha de venta') !!}
			{!! Form::text('created_at', $fecha_venta, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			{!! Form::label('notas','Notas') !!}
			{!! Form::text('notas', null, ['class' => 'form-control', 'placeholder' => 'Ingrese alguna nota']) !!}
		</div>
		<h4>Productos</h4>
        <div class="form-group">
            <label>Descripción: </label>
			<select id="combobox" name="combobox" class="selectpicker" data-live-search="true" data-width="75%">
                @foreach($productos as $producto)
                    <option value="{{$producto->id}}" data-subtext='{{$producto->id}} - {{$producto->precio}} - {{$producto->iva}} - {{$producto->ieps}}'>{{$producto->nombre}} - {{$producto->descripcion}}</option>
                @endforeach
            </select>			
            <a class="add_field_button">Agregar</a>
        </div>
        <table class="table">
            <tr>
                <th width="5%">Código:</th>
                <th width="35%">Descripción:</th>
                <th width="10%">Precio:</th>
                <th width="10%">Cantidad:</th>
                <th width="10%">Importe:</th>
                <th width="10%">Descuento %:</th>
                <th width="10%">Impuestos:</th>
                <th width="10%">Totales:</th>
                <th></th>
            </tr>
        </table>
        	<h4>Resumen de venta</h4>
			<div class="form-group col-lg-12">
			{!! Form::label('importe','Importe') !!}
			{!! Form::text('resumen_importe', '0.00', ['id'=>'resumen_importe' ,'class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			{!! Form::label('descuento','Descuento %') !!}
			{!! Form::text('resumen_descuento', '0.00', ['id'=>'resumen_descuento', 'class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			{!! Form::label('impuestos','Impuestos') !!}
			{!! Form::text('resumen_impuestos', '0.00', ['id'=>'resumen_impuestos', 'class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}

			{!! Form::label('total','Total') !!}
			{!! Form::text('resumen_total', '0.00', ['id'=>'resumen_total','class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}
			</div>

	    <div class="form-group">
			{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
    </div>
	@stop    
