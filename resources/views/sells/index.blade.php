@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
        	<h2 class="text-center TituloFR my-4 mb-5 ">Mis ventas</h2>

        	<p class="mb-5 text-center w-100">
				Conoce el balance de las ventas que haz realizado desde que eres miembro de la comunidad Fashion Recovery.
			</p>

			<div class="card mb-5 p-3 bg-light text-center">
				<h4 class="card-title green-color mb-4">
					<i class="fas fa-wallet mr-1"></i>
					Balance de cartera
				</h4>
				<div class="row mb-3">

					<div class="col-md-6 mb-4 mb-md-0">
						<p class="h6 mb-3">Disponible:
							<span class="green-color"><b>{{ $wallet->Amount }}</b></span>
						</p>

						@if($avaliableWallet > 0 && !$IsTransfer && !$wallet->IsPaid) 
							<a class="btn btn-sm btn-fr" href="{{ url('transfer') }}" type="button">
								Solicitar retiro
							</a>
						@elseif($avaliableWallet > 0 && $IsTransfer)
							<div class="alert alert-success show">
								Hemos recibido tu petición. <br>
								En breve nos podremos en contacto contigo.
							</div>
						@endif
					</div>
					<div class="col-md-6">
						<p class="h6">Pendiente:
							<span><b>${{ $pendingWallet }}</b></span>
						</p>
					</div>

				</div>
			</div>
			
			@include('auth.partials.seller-data')


			<div class="container">

				<hr>

				<ul class="nav nav-tabs flex-md-row flex-column p-0 mt-5 orders-list w-100" id="myTab" role="tablist">
				  	<!-- <li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="true">Ventas</a>
				  	</li> -->
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">
							En curso {{ count($pending) > 0 ? '('.count($pending).')' : '' }}
						</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="finalized-tab" data-toggle="tab" href="#finalized" role="tab" aria-controls="finalized" aria-selected="false">
							Finalizadas {{ count($finalized) > 0 ? '('.count($finalized).')' : '' }}
						</a>
				  	</li>
				  	<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="canceled-tab" data-toggle="tab" href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">
							Canceladas {{ count($canceled) > 0 ? '('.count($canceled).')' : '' }}
						</a>
				  	</li>
					<li class="nav-item px-md-0 px-4">
				    	<a class="nav-link green-link" id="return-tab" data-toggle="tab" href="#return" role="tab" aria-controls="return" aria-selected="false">
							Devoluciones {{ count($return) > 0 ? '('.count($return).')' : '' }}
						</a>
				  	</li>
				</ul>

				<div class="tab-content w-100 mb-5" id="myTabContent">
				  <!-- 	<div class="tab-pane fade show mt-4 active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
				  		@include('sells.partials.sells')
					</div>  -->
				  	<div class="tab-pane fade show mt-4 active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
				  		@include('sells.partials.pending')
				  	</div>
				  	<div class="tab-pane fade mt-4" id="finalized" role="tabpanel" aria-labelledby="finalized-tab">
				  		@include('sells.partials.finalized')
				  	</div>
				  	<div class="tab-pane fade mt-4" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
				  		@include('sells.partials.canceled')
				  	</div>
					<div class="tab-pane fade mt-4" id="return" role="tabpanel" aria-labelledby="return-tab">
				  		@include('sells.partials.return')
				  	</div>
				</div> 
			</div>
    	</div>
    </main>

<!-- Modal -->
@if(count($answers) > 0 )
@foreach($finalized as $order)
	<div class="modal fade js-results-rating-modal" id="modal-{{ $order->ItemID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLongTitle">Evaluación de la experiencia de compra</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			@foreach($answers[$order->ItemID] as $answer)
				<div class="form-group mb-4">
					<p>{{ $answer->QuestionID }}</p>

					@if(is_array($answer->Answer))
						<div class="text-left">
							@foreach($answer->Answer as $rank)
								@if($rank === 1) 
									<i class="fas fa-star yellow"></i>
								@else
									<i class="far fa-star gray"></i>
								@endif
							@endforeach
						</div>
					@else
						<p class="text-black-50"> <em>{{ $answer->Answer }}</em> </p>

					@endif

				</div>
			@endforeach

			<div class="text-center mt-5 mb-2">
				<button type="button" class="btn btn-secondary m-auto" data-dismiss="modal">Regresar</button>
			</div>
		</div>
		</div>
	</div>
	</div>
@endforeach
@endif
@endsection
