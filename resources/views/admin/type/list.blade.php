@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h2 class="text-center TituloFR my-4">Tipos</h2>

					@include('alerts.success')
  					@include('alerts.warning')

					<table class="table table-striped">
						<thead>
						    <tr>
							    <th scope="col">Nombre</th>
							    <th scope="col">Activa</th>
							    <th scope="col"></th>
						    </tr>
						  </thead>
						 <tbody>

						 	@foreach($types as $type)
						 		<tr>
								    <th> {{ $type->TypeName }} </th>
								    <td> {{ $type->Active }} </td>
								    <td>
										<a class="btn btn-success btn-sm" href="{{ route('types.edit',$type->TypeID) }}" role="button">Modificar</a>
										<a class="btn btn-danger btn-sm" href="{{ route('types.destroy',$type->TypeID) }}" role="button">Eliminar</a>
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
