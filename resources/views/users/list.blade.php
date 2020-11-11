@extends('dashboard.master')

@section('content')

	<main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          	<h2 class="text-center TituloFR my-4">Usuarios</h2>

					    @include('alerts.success')
  					  @include('alerts.warning')

              <users-list-component
                :users="{{ $users }}"
              >
              </users-list-component>

				</div>
			</div>
		</div>
	</main>

@endsection
