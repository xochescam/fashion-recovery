@extends('dashboard.master')

@section('content')

	<main id="main">
	    <div class="container pt-5">

			<h2 class="text-left TituloFR my-4 mb-5">Hola, {{ Auth::User()->Alias }}</h2>

			<div class="w-75">
				@include('alerts.success')
      			@include('alerts.warning')							
			</div>

			@if(!Auth::User()->Confirmed)

				<div class="alert alert-warning w-75" role="alert">
					Confirma tu dirección de correo electrónico 

					<a href="{{ url('resend-confirm-account',Auth::User()->id) }}" class="alert-link">reenviar enlace</a>.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif

		</div>

		<section id="offersDeLaSemana">
		  	<div class="container-fluid">
	
			    <div class="row justify-content-start shadow-lg p-3 mb-5 bg-white rounded mx-md-5">
	    			@foreach($items as $item)

						<div class="col-lg-3 col-md-4 col-sm-6 mb-4 mt-4">
						<a href="{{ url('items/'.$item->ItemID.'/public') }}" class="link-card">

				          <div class="card card--public card--item shadow p-3 mb-5 bg-white rounded d-flex align-items-stretch h-100">
				            <img class="card-img-top" src="{{ url('storage',$item->ThumbPath) }}" alt="Card image cap" height="200px;">
				            <div class="card-body">
				              <h4 class="card-title mb-0">{{ $item->BrandName }}</h4>

				                  @if(isset($item->offer))
				                    <div class="badges float-right mb-2">
				                      <span class="badge badge-pill badge-danger">{{ $item->offer }}</span>
				                      <span class="badge badge-pill badge-success">
				                        ${{ $item->PriceOffer }}
				                      </span>
				                    </div>
				                  @else
				                    <div class="badges float-right mb-2">
				                      <span class="badge badge-pill badge-success">
				                        {{ $item->ActualPrice }} 
				                      </span>
				                    </div>
				                  @endif

				                <div class="container-fade">
				                  <p>{{ $item->ItemDescription }}</p>
				                </div>

				              <p class="card-text" style="border-bottom: 1px solid gray; border-top: 1px solid gray;">
				                Talla: {{ $item->SizeName  }}<br />Color: {{ $item->ColorName }}</p>
				            </div>
				          </div>
				          </a>
				        </div>	
			        
			      @endforeach

			    </div>
		  	</div>
		</section>
	</main>
@endsection
