@extends('layouts.app')
	@section('title','Lista de productos')
	@section('content')
	<br>
	<div class="container">
    	<ol class="breadcrumb">
			<li class="active"><h4>Productos</h4></li>
		</ol>
	<a href="{{ route('productos.create') }}" class="btn btn-info">Registrar nuevo producto</a><hr>
	<table id="table" class="display" cellspacing="0" width="100%">
	<thead>
            <tr>
                <th>Id</th>
				<th>Nombre</th>
				<th>Descripción</th>
				<th>Precio</th>
				<th>Categoria</th>
				<th>Acción</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
             	<th>Id</th>
				<th>Nombre</th>
				<th>Descripción</th>
				<th>Precio</th>
				<th>Categoria</th>
				<th>Acción</th>
            </tr>
        </tfoot>
        <tbody>
           @foreach($productos as $producto)
				<tr>
					<td> {{ $producto->id }} </td>
					<td> {{ $producto->nombre }} </td>
					<td> {{ $producto->descripcion }} </td>
					<td> {{ $producto->precio }} </td>
					<td> {{ $producto->categoria }} </td>
					<td>
					<a href="{{ route('productos.edit', $producto->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true" title="Editar"></span></a>
					<a href="{{ route('productos.destroy',$producto->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo?')" class="btn btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
					</td>
				</tr>
				@endforeach
			</tbody>
    	</table>
	</div>
	@endsection