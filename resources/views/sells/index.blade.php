@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
        	<h2 class="text-center TituloFR my-4 mb-5 ">Mis ventas</h2>

        	<p class="mb-5 text-center w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

			@include('auth.partials.seller-data')


			<div class="container">

				<hr>

				<ul class="nav nav-tabs flex-md-row flex-column p-0 mt-5 orders-list w-100" id="myTab" role="tablist">
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="true">Ventas</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Ventas en curso</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="finalized-tab" data-toggle="tab" href="#finalized" role="tab" aria-controls="finalized" aria-selected="false">Ventas finalizadas</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="canceled-tab" data-toggle="tab" href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">Ventas canceladas</a>
				  	</li>
				</ul>

				<div class="tab-content w-100" id="myTabContent">
				  	<div class="tab-pane fade show mt-4 active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
				  		@include('sells.partials.sells')
					</div>
				  	<div class="tab-pane fade mt-4" id="pending" role="tabpanel" aria-labelledby="pending-tab">
				  		@include('sells.partials.pending')
				  	</div>
				  	<div class="tab-pane fade mt-4" id="finalized" role="tabpanel" aria-labelledby="finalized-tab">
				  		@include('sells.partials.finalized')
				  	</div>
				  	<div class="tab-pane fade mt-4" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
				  		@include('sells.partials.canceled')
				  	</div>
				</div> 
			</div>
    	</div>
    </main>

@endsection
