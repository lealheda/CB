	@extends('layouts.app')
	@section('title','Lista de clientes')
	@section('content')
	<br>
	@include('flash::message')
	<div class="container">
    	<ol class="breadcrumb">
			<li class="active"><h4>Clientes</h4></li>
		</ol>
	<a href="{{ route('clientes.create') }}" class="btn btn-info">Registrar nuevo cliente</a><hr>
	<table id="table" class="display" cellspacing="0" width="100%">
	<thead>
            <tr>
                <th>Id</th>
				<th>Nombre comercial</th>
				<th>Rfc</th>
				<th>Email</th>
				<th>Dirección</th>
				<th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
             	<th>Id</th>
				<th>Nombre comercial</th>
				<th>Rfc</th>
				<th>Email</th>
				<th>Dirección</th>
				<th>Acciones</th>
            </tr>
        </tfoot>
        <tbody>
           @foreach($clientes as $cliente)
				<tr>
					<td> {{ $cliente->id }} </td>
					<td> {{ $cliente->nombre_comercial }} </td>
					<td> {{ $cliente->rfc }} </td>
					<td> {{ $cliente->email }} </td>
					<td> {{ $cliente->calle .' '. $cliente->numero .' '. $cliente->colonia .', '. $cliente->codigo_postal .', '. $cliente->municipio .', '. $cliente->estado .', '. $cliente->pais }} </td>
					<td>
					<a href="{{ route('clientes.edit', $cliente->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true" title="Editar"></span></a>
					<a href="{{ route('clientes.destroy',$cliente->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo?')" class="btn btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
					</td>
				</tr>
				@endforeach
			</tbody>
    </table>
		</div>
	@endsection