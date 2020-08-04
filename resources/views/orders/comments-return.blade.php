@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
                      
                    <h2 class="text-center TituloFR mt-4 mb-5">Proceso de devolución</h2>

                    <p class="mb-5 text-center w-100">Motivo: {{ $rason }}</p>

                    <div class="col-md-10 m-auto d-flex flex-column">
                        @include('alerts.success')
  					    @include('alerts.warning')

                        @if(count($comments) === 0 && Auth::User()->isAdmin())
                            <p class="text-center text-secondary">Sin evidencia del vendedor.</p>
                        @endif

                        @if($IsBuyer === 'false' && !Auth::User()->isAdmin())
                            <div class="comments-return border-top {{ count($comments) > 0 ? '' : 'border-bottom mb-5' }} p-4">
                                <div class="media">
                                    <span class="mr-3 green-color">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                    <div class="media-body">    
                                        <h6 class="mt-0">
                                            <b class="green-color">Comprador</b>
                                            <small class="float-right">{{ $firstComment->date }}</small>
                                        </h6>
                                        <p>{{ $firstComment->Comment }}</p>
                                    
                                        <div class="d-flex mt-2">

                                            @foreach($firstComment->images as $image)
                                                <open-gallery-btn
                                                    :all="{{ $firstComment->images }}"
                                                    :image="{{ $image }}"
                                                >
                                                </open-gallery-btn>
                                            @endforeach

                                        </div>                                 
                                    </div>
                                </div>
                            </div>

                        @endif

                        @foreach($comments as $comment)
                            <div class="comments-return border-top p-4">
                                <div class="media">
                                    <span class="mr-3 green-color">
                                        <i class="fas fa-{{ $comment->user === 'Fashion Recovery' ? 'headset' : 'comment' }}"></i>
                                    </span>
                                    <div class="media-body">    
                                        <h6 class="mt-0">
                                            <b class="green-color">{{ $comment->user }}</b>
                                            <small class="float-right">{{ $comment->date }}</small>
                                        </h6>
                                        <p>{{ $comment->Comment }}</p>
                                    
                                        <div class="d-flex mt-2">

                                            @foreach($comment->images as $image)
                                                <open-gallery-btn
                                                    :all="{{ $comment->images }}"
                                                    :image="{{ $image }}"
                                                >
                                                </open-gallery-btn>
                                            @endforeach

                                        </div>                                 
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                
                    <div class="col-md-10 m-auto">

                        @if(count($comments) > 0)
                            <hr class="mb-5 mt-0">
                        @endif

                        @if(isset($return->Approved))
                            <div class="alert p-4 alert{{ $return->Approved ? '-success ' : '-danger' }}">
                                <div class="media">
                                    <span class="mr-3 rounded-circle bg-white">
                                        <i class="fas fa-file-alt m-3"></i>
                                    </span>
                                    <div class="media-body">    
                                        <h6 class="mt-0">
                                            <b>El proceso ha sido {{ $return->Approved ? 'aprobado.' : 'cancelado.' }}</b>
                                        </h6>
                                        <p>{{ $return->Comment }}</p>
                                        
                                        @if(!Auth::User()->isAdmin())
                                            <p>Ingresa a
                                                @if($IsBuyer === 'true')
                                                    <a href="{{ url('orders') }}" class="alert-link">mis pedidos</a> 
                                                @else
                                                    <a href="{{ url('sales') }}" class="alert-link">mis ventas</a> 
                                                @endif
                                            para ver el seguimiento de la prenda.</p>
                                        @endif              
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(Auth::User()->isAdmin() && !isset($return->Approved) && count($comments) > 0)

                            <form method="POST" action="{{ url(($IsBuyer === 'true' ? 'buyer' : 'seller').'-return/'.$return->ReturnID) }}" novalidate class="col-md-11 m-auto needs-validation">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="Approved">Evaluar devolución</label>
                                    <select id="Approved" class="form-control" name="Approved">
                                        <option value="" selected>- Seleccionar -</option>
                                        <option value="1">Aceptar</option>
                                        <option value="0">Cancelar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Comment">Comentario *</label>
                                    <textarea class="form-control" id="Comment" name="Comment" rows="4" required></textarea>
                                    <div class="invalid-feedback">
                                        El campo es obligatorio.
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-fr mb-2">
                                        <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                                        Enviar
                                    </button>
                                </div>
                            </form>

                        @elseif(!Auth::User()->isAdmin() && !isset($return->Approved) && $isTime)
                            <form method="POST" action="{{ url( ($IsBuyer === 'true' ? 'buyer' : 'seller').'-return/'.$return->ReturnID) }}" enctype="multipart/form-data"  novalidate class="col-md-11 m-auto needs-validation">
                                @csrf

                                <return-photos
                                    :errors="{{ $errors }}"
                                >
                                </return-photos>

                                <div class="form-group">
                                    <label for="Comment">Comentario *</label>
                                    <textarea class="form-control" id="Comment" name="Comment" rows="4" required></textarea>
                                    <div class="invalid-feedback">
                                        El campo es obligatorio.
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-fr mb-2">
                                        <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                                        Enviar
                                    </button>
                                </div>
                            </form>
                        @elseif(!Auth::User()->isAdmin() && !isset($return->Approved) && !$isTime) 
                            <div class="alert alert-danger text-center" role="alert">
                                Se ha agotado el tiempo para enviar evidencia.
                            </div>
                        @endif
                    </div>
				</div>
			</div>
		</div>
	</main>
    <modal-gallery></modal-gallery>
@endsection
