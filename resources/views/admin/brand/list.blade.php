@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h2 class="text-center TituloFR my-4">Marcas</h2>

					<table class="table table-striped">
						<thead>
						    <tr>
							    <th scope="col">Nombre</th>
							    <th scope="col">Departamento</th>
							    <th scope="col">Activa</th>
							    <th scope="col">Fecha de creación</th>
						    </tr>
						  </thead>
						 <tbody>

						 	@foreach($brands as $brand)
						 		<tr>
								    <th> {{ $brand->BrandName }} </th>
								    <td> {{ $brand->DepartmentID }} </td>
								    <td> {{ $brand->Active }} </td>
								    <td> {{ $brand->CreationDate }} </td>
							    </tr>
						 	@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</main>
@endsection
