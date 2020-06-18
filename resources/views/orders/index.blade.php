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

	  	<div class="form-group mb-4">
			<label class="font-weight-light">¿Qué calificación le das a tu compra?</label>
			<div class="rate">
				<input type="radio" id="buy-5" name="buy" value="5" class="rate__input"/>
				<label for="buy-5"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="buy-4" name="buy" value="4" class="rate__input"/>
				<label for="buy-4"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="buy-3" name="buy" value="3" class="rate__input"/>
				<label for="buy-3"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="buy-2" name="buy" value="2" class="rate__input"/>
				<label for="buy-2"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="buy-1" name="buy" value="1" class="rate__input"/>
				<label for="buy-1"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
			</div>
		</div>

		<div class="form-group mb-4">
			<label class="font-weight-light">¿Qué tan rápido fue tu envío?</label>
			<div class="rate">
				<input type="radio" id="shipping-5" name="shipping" value="5" class="rate__input"/>
				<label for="shipping-5"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="shipping-4" name="shipping" value="4" class="rate__input"/>
				<label for="shipping-4"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="shipping-3" name="shipping" value="3" class="rate__input"/>
				<label for="shipping-3"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="shipping-2" name="shipping" value="2" class="rate__input"/>
				<label for="shipping-2"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="shipping-1" name="shipping" value="1" class="rate__input"/>
				<label for="shipping-1"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
			</div>
		</div>

		<div class="form-group mb-4">
			<label class="font-weight-light">¿La descripción fue apropiada?</label>
			<div class="rate">
				<input type="radio" id="info-5" name="info" value="5" class="rate__input"/>
				<label for="info-5"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="info-4" name="info" value="4" class="rate__input"/>
				<label for="info-4"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="info-3" name="info" value="3" class="rate__input"/>
				<label for="info-3"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="info-2" name="info" value="2" class="rate__input"/>
				<label for="info-2"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="info-1" name="info" value="1" class="rate__input"/>
				<label for="info-1"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
			</div>
		</div>

		<div class="form-group mb-4">
			<label class="font-weight-light">¿Qué tal fue la comunicación con la vendedora?</label>
			<div class="rate">
				<input type="radio" id="comunication-5" name="comunication" value="5" class="rate__input"/>
				<label for="comunication-5"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="comunication-4" name="comunication" value="4" class="rate__input"/>
				<label for="comunication-4"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="comunication-3" name="comunication" value="3" class="rate__input"/>
				<label for="comunication-3"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="comunication-2" name="comunication" value="2" class="rate__input"/>
				<label for="comunication-2"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="comunication-1" name="comunication" value="1" class="rate__input"/>
				<label for="comunication-1"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
			</div>
		</div>

		<div class="form-group mb-4">
			<label class="font-weight-light">¿Cómo calificas la limpieza del producto?</label>
			<div class="rate">
				<input type="radio" id="cleaning-5" name="cleaning" value="5" class="rate__input"/>
				<label for="cleaning-5"  class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="cleaning-4" name="cleaning" value="4" class="rate__input"/>
				<label for="cleaning-4" class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="cleaning-3" name="cleaning" value="3" class="rate__input"/>
				<label for="cleaning-3" class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="cleaning-2" name="cleaning" value="2" class="rate__input"/>
				<label for="cleaning-2" class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="cleaning-1" name="cleaning" value="1" class="rate__input"/>
				<label for="cleaning-1" class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
			</div>
		</div>

		<div class="form-group mb-4">
			<label class="font-weight-light">¿Cómo calificas la presentación del paquete?</label>
			<div class="rate">
				<input type="radio" id="packaging-5" name="packaging" value="5" class="rate__input"/>
				<label for="packaging-5" class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="packaging-4" name="packaging" value="4" class="rate__input"/>
				<label for="packaging-4" class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="packaging-3" name="packaging" value="3" class="rate__input"/>
				<label for="packaging-3" class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="packaging-2" name="packaging" value="2" class="rate__input"/>
				<label for="packaging-2" class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
				<input type="radio" id="packaging-1" name="packaging" value="1" class="rate__input"/>
				<label for="packaging-1" class="rate__star">
					<i class="fas fa-star"></i> 
				</label>
			</div>
		</div>

		<div class="form-group">
			<label for="comment">¿Tienes algún comentario?</label>
			<textarea class="form-control" rows="3"></textarea>
		</div>

		<div class="text-center mt-5 mb-2">
			<button type="button" class="btn btn-secondary m-auto" data-dismiss="modal">Cancelar</button>
        	<button type="button" class="btn btn-fr m-auto">Confirmar</button>
		</div>

      </div>
    </div>
  </div>
</div>

@endsection
