@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h2 class="text-center TituloFR my-4">Devoluciones</h2>

					@include('alerts.success')
  					@include('alerts.warning')

					<table class="table table-striped">
						<thead>
						    <tr>
							    <th scope="col">Motivo</th>
								<th scope="col">Estado</th>
                                <th scope="col">Fecha</th>
								<th scope="col">Proceso</th>
								<th scope="col"></th>
						    </tr>
						  </thead>
						 <tbody>

						 	@foreach($returns as $item)
						 		<tr>
								    <td> {{ $item->RasonID }}
									<td> 
										@if(!isset($item->Approved))
											<span class="badge badge-secondary">Sin respuesta</span>
										@elseif($item->Approved)
											<span class="badge badge-success">Aprobada</span>	
										@elseif(!$item->Approved)
											<span class="badge badge-danger">Declinada</span>
										@endif
									</td>
									<td> {{ $item->CreationDate }} </td>
									<td>
										<a class="btn btn-sm btn-outline-green" href="{{ url('comments-return/'.$item->ReturnID.'/true') }}" role="button">Comprador</a>
										<a class="btn btn-sm btn-outline-green " href="{{ url('comments-return/'.$item->ReturnID.'/false') }}" role="button">Vendedor</a>
									</td>
                                    <td >
										<a class="btn btn-sm btn-fr" href="{{ url('show-return',$item->ReturnID) }}" role="button">Información</a>
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
