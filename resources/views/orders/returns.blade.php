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
								<th scope="col">Pre-aprobada</th>
								<th scope="col">Aprobada</th>
                                <th scope="col">Fecha</th>
							    <th scope="col"></th>
						    </tr>
						  </thead>
						 <tbody>

						 	@foreach($returns as $item)
						 		<tr>
								    <td> {{ $item->RasonID }}
									<td> 
										<span class="{{ isset($item->PreApproved) ? ($item->PreApproved ? 'text-success' : 'text-danger') : 'text-secondary' }} p-1">
											<i class="{{ isset($item->PreApproved) ? ($item->PreApproved ? 'fas fa-check' : 'fas fa-times') : 'fas fa-question' }} "></i>
										</span>
									</td>
									<td> 
										<span class="{{ isset($item->Approved) ? ($item->Approved ? 'text-success' : 'text-danger') : 'text-secondary' }} p-1">
											<i class="{{ isset($item->Approved) ? ($item->Approved ? 'fas fa-check' : 'fas fa-times') : 'fas fa-question' }} "></i>
										</span>
									</td>
									<td> {{ $item->CreationDate }} </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-fr" href="{{ url('show-return',$item->ReturnID) }}" role="button">Ver petición</a>
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
