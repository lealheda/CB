	@extends('layouts.app')
	@section('title','Resumen venta')
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
			<li class="active"><h4>Resumen de venta</h4></li>
		</ol>
    {!! Form::open(['route' => 'ventas.store', 'method'=> 'POST']) !!}
		<div class="form-group col-lg-6">
			{!! Form::label('created_at','Fecha de venta') !!}
			{!! Form::text('created_at', $fecha_venta, ['class' => 'form-control', 'readonly' => 'readonly', 'required']) !!}
		
			{!! Form::label('id_cliente','Clientes') !!}
			{!! Form::text('id_cliente', $cliente->nombre, ['class' => 'form-control', 'required', 'readonly' => 'readonly', ]) !!}
		</div>

		<div class="form-group col-lg-6">

			{!! Form::label('notas','Notas') !!}
			{!! Form::text('notas', $datos_venta->notas, ['class' => 'form-control', 'placeholder' => '', 'readonly' => 'readonly']) !!}

			{!! Form::label('referencia','Referencias') !!}
			{!! Form::text('referencia', $datos_venta->referencia, ['class' => 'form-control', 'placeholder' => 'Referencias', 'readonly' => 'readonly']) !!}
		</div>

		<h4>Resumen de productos</h4>

		<table id="table" class="display" width="100%">
		<thead>
	            <tr>
	            	<th>Id</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Subtotal $</th>
					<th>Descuento porcentaje %</th>
					<th>Descuento pesos $</th>
					<th>Iva $</th>
					<th>Ieps $</th>
					<th>Total $</th>
	            </tr>
	        </thead>
	        <tfoot>
	            <tr>
	            	<th>Id</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Subtotal $</th>
					<th>Descuento porcentaje %</th>
					<th>Descuento pesos $</th>
					<th>Iva $</th>
					<th>Ieps $</th>
					<th>Total $</th>
	            </tr>
	        </tfoot>
	        <tbody>
	           @foreach($detalles as $detalle)
					<tr>
					<td> {{ Form::number('id_producto[]', $detalle->id_producto, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

					<td> {{ Form::text('nombre_producto[]', $detalle->nombre_producto, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

					<td> {{ Form::number('precio[]', $detalle->precio, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

					<td> {{ Form::number('cantidad[]', $detalle->cantidad, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

					<td> {{ Form::number('subtotal[]', $detalle->subtotal, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

					<td> {{ Form::number('descuento_porcentaje[]', $detalle->descuento_porcentaje, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

					<td> {{ Form::number('descuento_pesos[]', $detalle->descuento_pesos, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>


					<td> {{ Form::number('iva[]', $detalle->iva, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

					<td> {{ Form::number('ieps[]', $detalle->ieps, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

					<td> {{ Form::number('total[]', $detalle->total, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

					</tr>
					@endforeach
						<td> Totales: </td>
						<td></td>
						<td></td>
						<td> {{ Form::number('final_cantidad', $resumen->cantidad, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

						<td> {{ Form::number('final_subtotal', $resumen->subtotal, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

						<td> {{ Form::number('final_porcentaje', $resumen->descuento_porcentaje, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

						<td> {{ Form::number('final_pesos', $resumen->descuento_pesos, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>
						
						<td> {{ Form::number('final_iva', $resumen->iva, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>

						<td> {{ Form::number('final_ieps', $resumen->ieps, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>
						
						<td> {{ Form::number('final_total', $resumen->total, ['class' => 'form-control', 'required', 'readonly' => 'readonly' ]) }} </td>
				</tbody>
	    </table>	
	    <div class="form-group">
			{!! Form::submit('Confirmar', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
    </div>
	@stop    
