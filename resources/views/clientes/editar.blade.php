@extends('layouts.app')
	@section('title','Editar cliente')
	@section('content')
    <div class="container">
    <hr>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
    <p class=""><h4>Editar cliente</h4></p>

    {!! Form::open(['route' => ['clientes.update', $cliente], 'method'=> 'PUT']) !!}
		<div class="form-group col-lg-6">
			{!! Form::label('nombre','Nombre') !!}
			{!! Form::text('nombre', $cliente->nombre, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('rfc','Rfc') !!}
			{!! Form::text('rfc', $cliente->rfc, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('telefono','Telefono') !!}
			{!! Form::text('telefono', $cliente->telefono, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('email','Correo electronico') !!}
		<div class="input-group">
			{!! Form::email('correo_electronico', $cliente->correo_electronico, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
        <span class="input-group-addon" id="basic-addon2">@example.com</span>
		</div>
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('calle','Calle') !!}
			{!! Form::text('calle', $cliente->calle, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('numero','Número') !!}
			{!! Form::text('numero', $cliente->numero, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('colonia','Colonia') !!}
			{!! Form::text('colonia', $cliente->colonia, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('codigo_postal','Codigo postal') !!}
			{!! Form::number('codigo_postal', $cliente->codigo_postal, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('municipio','Municipio') !!}
			{!! Form::text('municipio', $cliente->municipio, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('estado','Estado') !!}
			{!! Form::text('estado', $cliente->estado, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
		</div>
		<div class="form-group col-lg-6">
			{!! Form::label('pais','Pais') !!}
			{!! Form::text('pais', $cliente->pais, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
		</div>
		
		<div class="form-group col-lg-6">
			{!! Form::label('limite_credito','Limite de credito $') !!}
			{!! Form::number('limite_credito', $cliente->limite_credito, ['class' => 'form-control', 'required', 'placeholder' => '', 'min' => '0.00', 'step' => 'any']) !!}
		</div>
	
		<div class="form-group">
			{!! Form::submit('Editar', ['class' => 'btn btn-primary','onClick'=>'return validateCliente()']) !!}
		</div>	


	{!! Form::close() !!}
    </div>
	@stop    
