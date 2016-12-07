	@extends('layouts.app')
	@section('title','Editar producto')
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
			<li class="active"><h4>Editar producto</h4></li>
		</ol>
    {!! Form::open(['route' => ['productos.update', $producto], 'method'=> 'PUT']) !!}
		<div class="form-group">
			{!! Form::label('nombre','Nombre') !!}
			{!! Form::text('nombre', $producto->nombre, ['class' => 'form-control', 'required']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('descripcion','Descripción') !!}
			{!! Form::text('descripcion', $producto->descripcion, ['class' => 'form-control', 'required']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('precio','Precio $') !!}
			{!! Form::text('precio', $producto->precio, ['class' => 'form-control', 'required', 'min' => '0.00', 'step' => 'any' ]) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('iva','Iva $') !!}
			{!! Form::text('iva', $producto->iva, ['class' => 'form-control', 'required', 'min' => '0.00', 'step' => 'any']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('ieps','Ieps $') !!}
			{!! Form::text('ieps', $producto->ieps, ['class' => 'form-control', 'required', 'min' => '0.00', 'step' => 'any']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('descuento_maximo','Descuento maximo $') !!}
			{!! Form::text('descuento_maximo', $producto->descuento_maximo, ['class' => 'form-control', 'required', 'min' => '0.00', 'step' => 'any']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('categoria','Categoria') !!}
			{!! Form::select('categoria', array('Tecnologia'=>'Tecnologia','Otros'=>'Otros'),'Tecnologia', ['class' => 'form-control', 'required']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('unidades','Unidades') !!}
			{!! Form::select('unidades', array('Pieza'=>'Pieza','Litro'=>'Litro','Caja'=>'Caja'),'Pieza', ['class' => 'form-control', 'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
		</div>	
	{!! Form::close() !!}
    </div>
	@stop    
