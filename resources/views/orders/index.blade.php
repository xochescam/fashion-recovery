@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
        	<h2 class="text-center TituloFR my-4 mb-5 ">Mis pedidos</h2>

        	<p class="mb-5 text-center w-100">Encuentra toda la información referente a tus compras. ¿Qué he comprado? ¿Cuáles pedidos están activos? ¿Cuándo llega? ¿Qué he cancelado?</p>

			<div class="row">
				
				<div class="col-md-9 m-auto mb-3">
					@include('alerts.success')
					@include('alerts.warning')
				</div>

				<ul class="nav nav-tabs flex-md-row flex-column p-0 col-md-9 m-auto orders-list" id="myTab" role="tablist">
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">
							En curso {{ count($pending) > 0 ? '('.(count($pending)).')' : '' }}
						</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="finalized-tab" data-toggle="tab" href="#finalized" role="tab" aria-controls="finalized" aria-selected="false">
							Finalizados {{ count($finalized) > 0 ? '('.(count($finalized)).')' : '' }}
						</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="canceled-tab" data-toggle="tab" href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">
							Cancelados {{ count($canceled) > 0 ? '('.count($canceled).')' : '' }}
						</a>
				  	</li>
					<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="return-tab" data-toggle="tab" href="#return" role="tab" aria-controls="return" aria-selected="false">
							Devoluciones {{ count($return) > 0 ? '('.(count($return)).')' : '' }}
						</a>
				  	</li>
				</ul>

				<div class="tab-content col-md-9 m-auto" id="myTabContent">

				  	<div class="tab-pane fade show mt-4 active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
				  		@include('orders.partials.pending')
				  	</div>
				  	<div class="tab-pane fade mt-4" id="finalized" role="tabpanel" aria-labelledby="finalized-tab">
				  		@include('orders.partials.finalized')
				  	</div>
				  	<div class="tab-pane fade mt-4" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
				  		@include('orders.partials.canceled')
				  	</div>
					<div class="tab-pane fade mt-4" id="return" role="tabpanel" aria-labelledby="return-tab">
				  		@include('orders.partials.return')
				  	</div>
				</div>
			</div>

      </div>
    </main>

	<!-- Modal -->
<div class="modal fade js-rating-modal" id="confirmOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Evalua tu experiencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

	  	<form method="POST" class="js-rating-form">
		  @csrf
		  	@foreach($questions as $question)

				@if(!$question->IsText) 
					<div class="form-group mb-4">
						<label class="font-weight-light">{{ $question->Question }}</label>
						<div class="rate">
							<input type="radio" id="{{ $question->Slug }}-5" name="{{ $question->Slug }}" value="5" class="rate__input"/>
							<label for="{{ $question->Slug }}-5"  class="rate__star">
								<i class="fas fa-star"></i> 
							</label>
							<input type="radio" id="{{ $question->Slug }}-4" name="{{ $question->Slug }}" value="4" class="rate__input"/>
							<label for="{{ $question->Slug }}-4"  class="rate__star">
								<i class="fas fa-star"></i> 
							</label>
							<input type="radio" id="{{ $question->Slug }}-3" name="{{ $question->Slug }}" value="3" class="rate__input"/>
							<label for="{{ $question->Slug }}-3"  class="rate__star">
								<i class="fas fa-star"></i> 
							</label>
							<input type="radio" id="{{ $question->Slug }}-2" name="{{ $question->Slug }}" value="2" class="rate__input"/>
							<label for="{{ $question->Slug }}-2"  class="rate__star">
								<i class="fas fa-star"></i> 
							</label>
							<input type="radio" id="{{ $question->Slug }}-1" name="{{ $question->Slug }}" value="1" class="rate__input"/>
							<label for="{{ $question->Slug }}-1" class="rate__star">
								<i class="fas fa-star"></i> 
							</label>
						</div>
					</div>
				@else
					<div class="form-group">
						<label for="{{ $question->Slug }}">{{ $question->Question }}</label>
						<textarea class="form-control" id="{{ $question->Slug }}" name="{{ $question->Slug }}" rows="3"></textarea>
					</div>
				@endif

			@endforeach

			<div class="text-center mt-5 mb-2">
				<button type="button" class="btn btn-secondary m-auto" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-fr m-auto">Confirmar</button>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>

@endsection
