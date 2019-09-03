@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
        	<h2 class="text-center TituloFR my-4 mb-5 ">Mis pedidos</h2>

        	<p class="mb-5 text-center w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

			<div class="w-100">
				@include('alerts.success')
				@include('alerts.warning')
			</div>

			<div class="row">
				
				<ul class="nav nav-tabs flex-md-row flex-column p-0 col-md-9 m-auto orders-list" id="myTab" role="tablist">
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="true">Pedidos</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pedidos en curso</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="finalized-tab" data-toggle="tab" href="#finalized" role="tab" aria-controls="finalized" aria-selected="false">Pedidos finalizados</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="canceled-tab" data-toggle="tab" href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">Pedidos cancelados</a>
				  	</li>
				</ul>

				<div class="tab-content col-md-9 m-auto" id="myTabContent">
				  	<div class="tab-pane fade show mt-4 active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
				  		@include('orders.partials.orders')
					</div>
				  	<div class="tab-pane fade mt-4" id="pending" role="tabpanel" aria-labelledby="pending-tab">
				  		@include('orders.partials.pending')
				  	</div>
				  	<div class="tab-pane fade mt-4" id="finalized" role="tabpanel" aria-labelledby="finalized-tab">
				  		@include('orders.partials.finalized')
				  	</div>
				  	<div class="tab-pane fade mt-4" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
				  		@include('orders.partials.canceled')
				  	</div>
				</div>
			</div>

      </div>
    </main>

@endsection
