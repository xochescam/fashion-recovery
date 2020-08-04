@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
        	<h2 class="text-center TituloFR my-4 mb-5 ">Mi Cartera</h2>

        	<p class="mb-5 text-center w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

			<div class="w-100 mb-5">
				@include('alerts.success')
				@include('alerts.warning')
			</div>

			<div class="card mb-5 p-3 bg-light text-center">
				<h4 class="card-title green-color mb-4">
					<i class="fas fa-wallet mr-1"></i>
					Balance de cartera
				</h4>
				<div class="row mb-3">

					<div class="col-md-6 mb-4 mb-md-0">
						<p class="h6 mb-3">Disponible:

							<span class="green-color"><b>{{ isset($wallet->Amount) ? $wallet->Amount  : '$0' }}</b></span>
						</p>

						@if(!isset($wallet->IsTransfer)) 
							<a class="btn btn-sm btn-fr" href="{{ url('transfer-wallet') }}" type="button">
								Solicitar transferencia
							</a>
						@elseif(isset($wallet->IsTransfer) && !$wallet->IsTransfer)
			
						@endif
					</div>
					<div class="col-md-6">
						<p class="h6">Pendiente:
							<span><b>$0</b></span>
						</p>
					</div>

				</div>
			</div>
    	</div>
    </main>
@endsection
