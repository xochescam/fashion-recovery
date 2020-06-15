@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
        	<h2 class="text-center TituloFR my-4 mb-5 ">Mis pedidos</h2>

        	<p class="mb-5 text-center w-100">Encuentra toda la información referente a tus compras. ¿Qué he comprado? ¿Cuáles pedidos están activos? ¿Cuándo llega? ¿Qué he cancelado?</p>

			<div class="w-100">
				@include('alerts.success')
				@include('alerts.warning')
			</div>

			<div class="row">
				
				<ul class="nav nav-tabs flex-md-row flex-column p-0 col-md-9 m-auto orders-list" id="myTab" role="tablist">
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="true">
							Pedidos ({{ count($orders) }})
						</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">
							Pedidos en curso ({{ count($pending) }})
						</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="finalized-tab" data-toggle="tab" href="#finalized" role="tab" aria-controls="finalized" aria-selected="false">
							Pedidos finalizados ({{ count($finalized) }})
						</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="canceled-tab" data-toggle="tab" href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">
							Pedidos cancelados ({{ count($canceled) }})
						</a>
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

	<!-- Modal -->
<div class="modal fade" id="confirmOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirmar pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

	  	<div class="row">
			<p class="col-md-5 font-weight-light">Estado de las prendas</p>
			<div class="text-left col-md-7">
				<i class="fas fa-star yellow"></i> 
				<i class="fas fa-star yellow"></i> 
				<i class="fas fa-star yellow"></i> 
				<i class="far fa-star gray"></i> 
				<i class="far fa-star gray"></i>
			</div>
		</div>

		<div class="row">
			<p class="col-md-5 font-weight-light">Vendedor</p>
			<div class="text-left col-md-7">
				<i class="fas fa-star yellow"></i> 
				<i class="fas fa-star yellow"></i> 
				<i class="fas fa-star yellow"></i> 
				<i class="far fa-star gray"></i> 
				<i class="far fa-star gray"></i>
			</div>
		</div>

		<div class="row">
			<p class="col-md-5 font-weight-light">Envío</p>
			<div class="text-left col-md-7">
				<i class="fas fa-star yellow"></i> 
				<i class="fas fa-star yellow"></i> 
				<i class="fas fa-star yellow"></i> 
				<i class="far fa-star gray"></i> 
				<i class="far fa-star gray"></i>
			</div>
		</div>
		


      </div>
      <div class="modal-footer">
		<div class="m-auto">
			<button type="button" class="btn btn-secondary m-auto" data-dismiss="modal">Cancelar</button>
        	<button type="button" class="btn btn-fr m-auto">Confirmar</button>
		</div>
      </div>
    </div>
  </div>
</div>

@endsection
