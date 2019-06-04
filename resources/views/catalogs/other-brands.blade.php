@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h2 class="text-center TituloFR my-4">Otras marcas</h2>

					<table class="table table-striped">
						<thead>
						    <tr>
							    <th scope="col">Marca</th>
							    <th scope="col">Tipo de ropa</th>
							    <th scope="col">Talla</th>
						    </tr>
						  </thead>
						 <tbody>

						 	@foreach($otherBrands as $item)
						 		<tr>
								    <th> {{ $item->OtherBrand }} </th>
								    <td> {{ $item->OtherClothingType }} </td>
								    <td> {{ $item->OtherSize }} </td>	    
							    </tr>
						 	@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</main>
@endsection
