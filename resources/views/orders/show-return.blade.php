@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h2 class="text-center TituloFR mt-4 mb-5">Devolución</h2>

					@include('alerts.success')
  					@include('alerts.warning')


                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Información
                                </div>
                                <div class="card-body">

                                    <div class="d-flex float-right mb-3">
                                        <a href="{{ url('comments-return/'.$data['return']['ReturnID'].'/false') }}" class="btn btn-outline-green btn-block">Vendedor</a>
                                    </div>

                                    <dl>    
                                        <dt>Prenda</dt>
                                        <dd class="mb-3">
                                            <a href="{{ url('items/'.$data['infoOrder']['ItemID'].'/public') }}" target="_blank" class="green-link"> 
                                                Ver prenda
                                            </a>
                                        </dd>

                                        <dt>Vendedor</dt>
                                        <dd class="mb-3"> <a href="{{ url('user',$data['seller']) }}" class="green-link">{{ $data['seller'] }}</a></dd>

                                        <dt>Email</dt>
                                        <dd class="mb-3">{{ $data['email'] }}</dd>

                                        <dt>Origen</dt>
                                        <dd class="mb-3">{{ $data['origen'] }}</dd>
                                        
                                        <dt>Paquetería</dt>
                                        <dd class="mb-3">{{ $data['infoOrder']['PackingName'] }} </dd>

                                        <dt>Fecha de compra</dt>
                                        <dd class="mb-3">{{ $data['infoOrder']['CreationDate'] }} </dd>

                                        <dt>Fecha de entrega</dt>
                                        <dd>{{ $data['infoOrder']['UpdateDate'] }} </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Solicitud

                                    @if(isset($data['return']['Approved']) && $data['return']['Approved'])
                                        <span class="badge badge-success float-right">Aprobada</span>
                                    @elseif(isset($data['return']['Approved']) && !$data['return']['Approved'])
                                        <span class="badge badge-danger float-right">Declinada</span>
                                    @endif
                                </div>
                                <div class="card-body">

                                    <div class="d-flex float-right mb-3">
                                        <a href="{{ url('comments-return/'.$data['return']['ReturnID'].'/true') }}" class="btn btn-outline-green btn-block">Comprador</a>
                                    </div>

                                    <dl>
                                        <dt>Comprador</dt>
                                        <dd class="mb-3"> <a href="{{ url('user',$data['buyer']) }}" class="green-link">{{ $data['buyer'] }}</a></dd>

                                        <dt>Destino</dt>
                                        <dd class="mb-3">{{ $data['destino'] }}</dd>

                                        <dt>Email</dt>
                                        <dd class="mb-3"> {{ $data['buyer'] }} </dd>
                                        
                                        <dt>Motivo</dt>
                                        <dd class="mb-3">{{ $data['return']['RasonID'] }}</dd>
                                        
                                        <dt>Fecha de realización</dt>
                                        <dd>{{ $data['return']['CreatedDate'] }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    <div>
                            
				</div>
			</div>
		</div>
	</main>
@endsection
