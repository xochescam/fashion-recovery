@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h2 class="text-center TituloFR my-4">Marcas</h2>

					@include('alerts.success')
  					@include('alerts.warning')

  					<div class="w-auto float-right mb-4">
						<a class="btn btn-fr" href="{{ url('brands/create') }}" role="button">Crear</a>
					</div>

					<table class="table table-striped">
						<thead>
						    <tr>
							    <th scope="col">Nombre</th>
							    <th scope="col">Activa</th>
							    <th scope="col"></th>
						    </tr>
						  </thead>
						 <tbody>

						 	@foreach($brands as $item)
						 		<tr>
								    <th> {{ $item->BrandName }} </th>
								    <td>
										@if($item->Active)
											<i class="fas fa-check green-color"></i>
										@else
											<i class="fas fa-times text-danger"></i>
										@endif								    
									</td>								    
									<td>
										<a class="btn btn-sm btn-fr" href="{{ route('brands.edit',$item->BrandID) }}" role="button">Modificar</a>
										<a class="btn btn-danger btn-sm" href="{{ route('brands.destroy',$item->BrandID) }}" role="button">Eliminar</a>
										@if(!$item->Verified)
											<a class="btn btn-warning btn-sm text-light" href="{{ route('brands.validate',$item->BrandID) }}" role="button">Validar</a>
										@endif
									</td>
							    </tr>
						 	@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</main>
@endsection
