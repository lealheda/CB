@extends('layouts.app')
	@section('title','Lista de ventas')
	@section('content')
	<br>
	@include('flash::message')
	<div class="container">
    	<ol class="breadcrumb">
			<li class="active"><h4>Ventas</h4></li>
		</ol>
	<a href="{{ route('ventas.create') }}" class="btn btn-info">Registrar nueva venta</a><hr>
	<table id="table" class="display" cellspacing="0" width="100%">
	<thead>
            <tr>
                <th>Id</th>
				<th>Cliente</th>
				<th>Fecha de venta</th>
				<th>Total</th>
				<th>Notas</th>
				<th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
             	<th>Id</th>
				<th>Cliente</th>
				<th>Fecha de venta</th>
				<th>Total</th>
				<th>Notas</th>
				<th>Acciones</th>
            </tr>
        </tfoot>
        <tbody>
           @foreach($ventas as $venta)
				<tr>
					<td> {{ $venta->id }} </td>
					<td> {{ $venta->nombre_cliente }} </td>
					<td> {{ $venta->created_at }} </td>
					<td> {{ $venta->total }} </td>
					<td> {{ $venta->notas }} </td>
					<td>
					<a href="{{ route('ventas.view', $venta->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true" title="Visualizar"></span></a>
					<a href="{{ route('ventas.pdf', $venta->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-save-file" aria-hidden="true" title="Pdf"></span></a>
					<a href="{{ route('ventas.update', $venta->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-open-file" aria-hidden="true" title="Facturar"></span></a>
					<a href="{{ route('ventas.destroy',$venta->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo?')" class="btn btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
					</td>
				</tr>
				@endforeach
			</tbody>
    </table>
		</div>
	@endsection