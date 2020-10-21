@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h2 class="text-center TituloFR my-4">Marcas</h2>

					@include('alerts.success')
  					@include('alerts.warning')

					<brands-component
						:brands="{{ $brands }}"
						:departments="{{ json_encode($departments) }}"
					>
					</brands-component>
				</div>
			</div>
		</div>
	</main>
@endsection
