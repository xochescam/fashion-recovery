@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h1 class="text-left TituloFR my-4">Panel de administración</h1>

						<div class="alert alert-success" role="alert">
							¡Hola {{ Auth::User()->Name }}!
						</div>
				</div>
			</div>
		</div>
	</main>
@endsection
