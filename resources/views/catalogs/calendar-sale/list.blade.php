@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h2 class="text-center TituloFR my-4">Calendario de ofertas</h2>

					@include('alerts.success')
  					@include('alerts.warning')

					<div class="w-auto float-right mb-4">
						<a class="btn btn-fr" href="{{ url('calendar-sales/create') }}" role="button">Crear</a>
					</div>

					<table class="table table-striped">
						<thead>
						    <tr>
							    <th scope="col">Nombre</th>
							    <th scope="col">Periodo de inicio</th>
							    <th scope="col">Periodo de fin</th>
							    <th scope="col">Descuento</th>
							    <th scope="col">Activa</th>
							    <th scope="col"></th>
						    </tr>
						  </thead>
						 <tbody>

						 	@foreach($calendarSales as $item)
						 		<tr>
								    <th> {{ $item->Holiday }} </th>
								    <td> {{ $item->PeriodStart }}  </td>
								    <td> {{ $item->PeriodEnd }}  </td>
								    <td> {{ $item->Discount }} </td>
								    <td>
								    	@if($item->Active)
											<i class="fas fa-check green-color"></i>
										@else
											<i class="fas fa-times text-danger"></i>
										@endif
								    </td>
								    <td>
										<a class="btn btn-sm btn-fr" href="{{ route('calendar-sales.edit',$item->CalendarSalesID) }}" role="button">Modificar</a>
										<a class="btn btn-danger btn-sm" href="{{ route('calendar-sales.destroy',$item->CalendarSalesID) }}" role="button">Eliminar</a>
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
