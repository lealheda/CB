	@extends('layouts.app')
	@section('title','Nuevo cliente')
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
			<li class="active"><h4>Nuevo cliente</h4></li>
		</ol>
    {!! Form::open(['route' => 'clientes.store', 'method'=> 'POST']) !!}
		<div class="form-group col-lg-6">
			{!! Form::label('nombre','Nombre') !!}
			{!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre del cliente']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('rfc','Rfc') !!}
			{!! Form::text('rfc', null, ['class' => 'form-control', 'required', 'placeholder' => 'Rfc']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('telefono','Telefono') !!}
			{!! Form::text('telefono', null, ['class' => 'form-control', 'required', 'placeholder' => 'Telefono']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('email','Correo electronico') !!}
		<div class="input-group">
			{!! Form::email('correo_electronico', null, ['class' => 'form-control', 'required', 'placeholder' => 'Correo electronico']) !!}
        <span class="input-group-addon" id="basic-addon2">@example.com</span>
		</div>
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('calle','Calle') !!}
			{!! Form::text('calle', null, ['class' => 'form-control', 'required', 'placeholder' => 'Calle']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('numero','Número') !!}
			{!! Form::text('numero', null, ['class' => 'form-control', 'required', 'placeholder' => 'Numero']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('colonia','Colonia') !!}
			{!! Form::text('colonia', null, ['class' => 'form-control', 'required', 'placeholder' => 'Colonia']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('codigo_postal','Codigo postal') !!}
			{!! Form::number('codigo_postal', null, ['class' => 'form-control', 'required', 'placeholder' => 'Codigo postal']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('municipio','Municipio') !!}
			{!! Form::text('municipio', null, ['class' => 'form-control', 'required', 'placeholder' => 'Municipio']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('estado','Estado') !!}
			{!! Form::text('estado', null, ['class' => 'form-control', 'required', 'placeholder' => 'Estado']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('pais','Pais') !!}
			{!! Form::text('pais', null, ['class' => 'form-control', 'required', 'placeholder' => 'Pais']) !!}
		</div>
		
		<div class="form-group col-lg-6">
			{!! Form::label('limite_credito','Limite de credito $') !!}
			{!! Form::number('limite_credito', null, ['class' => 'form-control', 'required', 'placeholder' => 'Limite de credito $', 'min' => '0.00', 'step' => 'any']) !!}
		</div>
	
		<div class="form-group">
			{!! Form::submit('Registrar', ['class' => 'btn btn-primary','onClick'=>'return validateCliente()']) !!}
		</div>	
	{!! Form::close() !!}
    </div>
	@stop    
