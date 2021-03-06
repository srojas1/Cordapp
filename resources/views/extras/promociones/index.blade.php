<div class="row">
	<div class="col-xs-8">
		<p class="lead">
		</p>
	</div>
	<div class="col-xs-4">
		<div class="pull-right">
			<br>
			<a class="btn btn-primary" href="{!! URL::route('promocion.create') !!}">Agregar Promoción</a>
		</div>
	</div>
</div>
<br>
<div class="well">
	<table class="table">
		<thead>
		<th>PROMOCIÓN</th>
		<th>PRODUCTOS RELACIONADOS</th>
		<th>PRECIO</th>
		<th>FECHA INICIO</th>
		<th>FECHA FIN</th>
		<th>STOCK MAXIMO</th>
		<th>VENTAS</th>
		<th>INGRESOS</th>
		<th>ACCIONES</th>
		</thead>
		<tbody>
		@foreach ($promocion as $prom)
		<tr>
			<td>{{$prom->promocion}}</td>
			<td>[imagen]</td>
			<td>{{$prom->precio}}</td>
			<td>{{$prom->fecha_inicio}}</td>
			<td>{{$prom->fecha_fin}}</td>
			<td>{{$prom->stock_maximo}}</td>
			<td>[ventas]</td>
			<td>[ingresos]</td>
			<td>
				<a class="btn btn-info" href=""><i class="fa fa-pencil-square-o"></i></a>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_promocion_{!! $prom->id !!}"><i class="fa fa-times"></i></button>&nbsp
			</td>
		</tr>
		@endforeach
		</tbody>
	</table>
</div>

@section('bottom')
	@auth('edit')
		@include('extras.promociones.deletes')
	@endauth
@stop