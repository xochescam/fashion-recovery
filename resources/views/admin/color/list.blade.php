@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h2 class="text-center TituloFR my-4">Colores</h2>

					@include('alerts.success')
  					@include('alerts.warning')

					<table class="table table-striped">
						<thead>
						    <tr>
							    <th scope="col">Nombre</th>
							    <th scope="col">Activo</th>
							    <th scope="col"></th>
						    </tr>
						  </thead>
						 <tbody>

						 	@foreach($colors as $color)
						 		<tr>
								    <th> {{ $color->ColorName }} </th>
								    <td> {{ $color->Active }} </td>
								    <td>
										<a class="btn btn-success btn-sm" href="{{ route('colors.edit',$color->ColorID) }}" role="button">Modificar</a>
										<a class="btn btn-danger btn-sm" href="{{ route('colors.destroy',$color->ColorID) }}" role="button">Eliminar</a>
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
