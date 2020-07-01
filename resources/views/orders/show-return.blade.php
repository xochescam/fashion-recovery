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
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Información
                                </div>
                                <div class="card-body">
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
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Solicitud
                                </div>
                                <div class="card-body">
                                    <dl>
                                        <dt>Comprador</dt>
                                        <dd class="mb-3"> <a href="{{ url('user',$data['buyer']) }}" class="green-link">{{ $data['buyer'] }}</a></dd>
                                        
                                        <dt>Motivo</dt>
                                        <dd class="mb-3">{{ $data['return']['RasonID'] }}</dd>
                                        
                                        <dt>Comentario</dt>
                                        <dd class="mb-3">
                                            <p class="text-secondary">{{ isset($data['return']['Comment']) ? $data['return']['Comment'] : 'Sin comentario' }} </p>
                                        </dd>
                                        
                                        <dt>Fotos</dt>
                                        <dd class="mb-3"> 
                                        
                                            @foreach($data['images'] as $key => $value)
                                                @if($value->IsBuyer)
                                                    <a href="{{ url('storage',$value->ReturnUrl) }}" download class="green-link"> 
                                                        <i class="fas fa-download"></i> 
                                                        Imagen {{ $key + 1}}
                                                    </a> <br>
                                                @endif
                                            @endforeach
                                        </dd>
                                        
                                        <dt>Fecha de realización</dt>
                                        <dd>{{ $data['return']['CreatedDate'] }}</dd>
                                        
                                    </dl>

                                    <hr class="px-2">

                                    <p> <b>Pre-aprobación</b> </p>

                                    @if(!isset($data['return']['PreApproved']))
                                        <div class="row">
                                            <div class="col-md-6 mb-2 mb-md-0">
                                                <a href="{{ url('pre-return/'.$data['return']['ReturnID'].'/true') }}" class="btn btn-fr btn-block">Aceptar</a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ url('pre-return/'.$data['return']['ReturnID'].'/false') }}"  class="btn btn-danger btn-block">Cancelar</a>                                        
                                            </div>
                                        </div>
                                    @elseif(!$data['return']['PreApproved'])
                                        <div class="alert alert-danger text-center" role="alert">
                                            Cancelada
                                        </div>
                                    @elseif($data['return']['PreApproved']) 
                                        <div class="alert alert-success text-center" role="alert">
                                            Aceptada
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="card">
                                <div class="card-header">
                                   Evidencia
                                </div>
                                <div class="card-body">
                                    @if(!isset($data['return']['Answer'])) 

                                    <p class="text-secondary">Sin evidencias</p>

                                    @else

                                        <dl>
                                            <dt>Comentario</dt>
                                            <dd class="mb-3">
                                                <p class="text-secondary">{{ isset($data['return']['Answer']) ? $data['return']['Answer']: 'Sin comentario' }} </p>
                                            </dd>
                                            
                                            <dt>Fotos</dt>
                                            <dd class="mb-3"> 
                                            
                                                @foreach($data['images'] as $key => $value)
                                                    @if(!$value->IsBuyer)
                                                        <a href="{{ url('storage',$value->ReturnUrl) }}" download class="green-link"> 
                                                            <i class="fas fa-download"></i> 
                                                            Imagen {{ $key + 1}}
                                                        </a> <br>
                                                    @endif
                                                @endforeach
                                            </dd>
                                            
                                            <dt>Fecha de respuesta</dt>
                                            <dd>{{ $data['return']['UpdateDate'] }}</dd>
                                        </dl>

                                        <hr class="px-2">

                                        <p> <b>Aprobación</b> </p>

                                        @if(!isset($data['return']['Approved']))
                                            <div class="row">
                                                <div class="col-md-6 mb-2 mb-md-0">
                                                    <a href="{{ url('return/'.$data['return']['ReturnID'].'/true') }}" class="btn btn-fr btn-block">Aceptar</a>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="{{ url('return/'.$data['return']['ReturnID'].'/false') }}"  class="btn btn-danger btn-block">Cancelar</a>                                        
                                                </div>
                                            </div>
                                        @elseif(!$data['return']['Approved'])
                                            <div class="alert alert-danger text-center" role="alert">
                                                Cancelada
                                            </div>
                                        @elseif($data['return']['Approved']) 
                                            <div class="alert alert-success text-center" role="alert">
                                                Aceptada
                                            </div>
                                        @endif
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    <div>
                            
				</div>
			</div>
		</div>
	</main>
@endsection
