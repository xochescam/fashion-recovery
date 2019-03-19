@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h2 class="text-center TituloFR my-4">Departamentos</h2>

					<div class="w-auto float-right mb-4">
						<a class="btn btn-success" href="{{ url('departments/create') }}" role="button">Crear</a>
					</div>

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

						 	@foreach($departments as $department)
						 		<tr>
								    <th> {{ $department->DepName }} </th>
								    <td> {{ $department->Active }} </td>
								    <td>
										<a class="btn btn-success btn-sm" href="{{ route('departments.edit',$department->DepartmentID) }}" role="button">Modificar</a>
										<a class="btn btn-danger btn-sm" href="{{ route('departments.destroy',$department->DepartmentID) }}" role="button">Eliminar</a>
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
