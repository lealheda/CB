	@extends('layouts.app')
	@section('title','Nuevo producto')
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
			<li class="active">Nuevo producto</li>
		</ol>
    {!! Form::open(['route' => 'productos.store', 'method'=> 'POST']) !!}
		<div class="form-group">
			{!! Form::label('nombre','Nombre') !!}
			{!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre del producto']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('descripcion','Descripción') !!}
			{!! Form::text('descripcion', null, ['class' => 'form-control', 'required', 'placeholder' => 'Descripción']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('precio','Precio $') !!}
			{!! Form::number('precio', 0, ['class' => 'form-control', 'required', 'placeholder' => 'Precio $', 'min' => '0.00', 'step' => 'any']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('iva','Iva %') !!}
			{!! Form::number('iva', 0, ['class' => 'form-control', 'required', 'placeholder' => 'Iva %', 'min' => '0.00', 'step' => 'any']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('ieps','Ieps %') !!}
			{!! Form::number('ieps', 0, ['class' => 'form-control', 'required', 'placeholder' => 'Ieps %', 'min' => '0.00', 'step' => 'any' ]) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('descuento_maximo','Descuento maximo %') !!}
			{!! Form::number('descuento_maximo', 0, ['class' => 'form-control', 'required', 'placeholder' => 'Descuento maximo %', 'min' => '0.00', 'step' => 'any']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('categoria','Categoria') !!}
			{!! Form::select('categoria', array('Filtro'=>'Filtro','Aceite'=>'Aceite'),'Filtro', ['class' => 'form-control', 'required']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('unidades','Unidades') !!}
			{!! Form::select('unidades', array('Litro'=>'Litro','Pieza'=>'Pieza','Caja'=>'Caja'),'Litro', ['class' => 'form-control', 'required']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('costo','Costo $') !!}
			{!! Form::number('costo', 0, ['class' => 'form-control', 'required', 'placeholder' => 'Costo $', 'min' => '0.00', 'step' => 'any']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('minimo_inventario','Minimo en inventario') !!}
			{!! Form::number('minimo_inventario', 0, ['class' => 'form-control', 'required', 'placeholder' => 'Minimo en inventario', 'min' => '0.00', 'step' => 'any']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
		</div>	
	{!! Form::close() !!}
    </div>
	@stop    
