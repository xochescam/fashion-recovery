@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h2 class="text-center TituloFR my-4">Tipo de ropa</h2>

					@include('alerts.success')
  					@include('alerts.warning')

					<table class="table table-striped">
						<thead>
						    <tr>
							    <th scope="col">Nombre</th>
							    <th scope="col">Marca</th>
							    <th scope="col">Departamento</th>
							    <th scope="col">Activa</th>
							    <th scope="col"></th>
						    </tr>
						  </thead>
						 <tbody>

						 	@foreach($clothingTypes as $item)
						 		<tr>
								    <th> {{ $item->ClothingTypeName }} </th>
								    <td> {{ $item->BrandName }} </td>
								    <td> {{ $item->DepName }}</td>
								    <td> {{ $item->Active }} </td>
								    <td>
										<a class="btn btn-success btn-sm" href="{{ route('clothing-types.edit',$item->ClothingTypeID) }}" role="button">Modificar</a>
										<a class="btn btn-danger btn-sm" href="{{ route('clothing-types.destroy',$item->ClothingTypeID) }}" role="button">Eliminar</a>
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
