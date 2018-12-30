<div role="tabpanel"
	 class="tab-pane" id="categorias">
	<div class="board-body shadow-sm border-left border-right border-bottom">
		<div class="container-fluid">
			<div class="table-responsive">
				<table class="category_table table table-hover">
					<thead class="thead-light">
					<tr>
						<th scope="col"><div class="d-flex justify-content-center">CATEGORÍA</div></th>
						<th scope="col"><div class="d-flex justify-content-center">PRODUCTOS</div></th>
						<th scope="col"><div class="d-flex justify-content-center">VENTAS</div></th>
						<th scope="col"><div class="d-flex justify-content-center">INGRESOS</div></th>
						<th scope="col"><div class="d-flex justify-content-center">ACCIONES</div></th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td colspan="5">
							<form>
								<div class="crear-categoria d-flex justify-content-start pt-3">
									<div class="form-group">
										<div class="input-group">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
												<label class="custom-file-label" for="inputGroupFile04"><i class="material-icons">add_photo_alternate</i></label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<input type="text" class="form-control nombre-nueva-categoria nueva_categoria" placeholder="Nombre de categoría">
									</div>
									<div class="form-group">
										<button type="button" class="crear_categoria btn btn-primary">Crear categoría</button>
									</div>
									<div class="form-group">
										<small class="help">
											<a tabindex="0" class="btn badge badge-pill badge-secondary badge-light" role="button" data-toggle="tooltip" title="Agrega una imagen (jpp) de 120px x 120px">
												<i class="material-icons">help</i>
											</a>
										</small>
									</div>
								</div>
							</form>
						</td>
					</tr>
					@if(count($categoria)>0)
						@foreach ($categoria as $key1=>$cat)
							<tr>
								<th scope="row" class="align-middle"><div class="d-flex align-items-center"><img src="{{ asset('images/producto-icon.jpg') }}" alt="..." class="thumbnail border-top border-bottom border-right border-left"><div>{{$cat->categoria}}</div></div></th>
								<?php $sumProductos = 0;
								$sumVentas = 0;
								$sumIngresos=0;
								?>
								@foreach($cat->products as $key=>$catp)
									<?php $sumProductos++;?>
									@foreach($catp->orders as $nkey2=>$ord)
										<?php
										$sumVentas+=$ord->pivot->cantidad;
										$sumIngresos += $ord->pivot->cantidad*$catp->precio;
										?>
									@endforeach
								@endforeach
								<td class="align-middle"><div class="d-flex justify-content-center">{{$sumProductos}}</div></td>
								<td class="align-middle"><div class="d-flex justify-content-center">{{$sumVentas}}</div></td>
								<td class="align-middle"><div class="d-flex justify-content-center">S/ {{number_format($sumIngresos,2)}}</div></td>
								<td class="align-middle">
									<div class="d-flex justify-content-center">
										<a href="#" class="accion">
											<i class="material-icons">remove_red_eye</i>
										</a>
										<a href="#modalEditarCategoria_{!! $cat->id !!}" class="accion"
										   data-toggle="modal"
										   data-target="#modalEditarCategoria_{!! $cat->id !!}">
											<i class="material-icons">edit</i>
										</a>
										<input type="hidden" class="cat_id" value="{{$cat->id}}"/>
										<a href="#delete_categoria_{!! $cat->id !!}" data-toggle="modal" data-target="#delete_categoria_{!! $cat->id !!}" class="accion">
											<i class="material-icons">close</i>
										</a>
									</div>
								</td>
							</tr>
						@endforeach
					@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>