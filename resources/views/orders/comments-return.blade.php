@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
                      
                    <h2 class="text-center TituloFR mt-4 mb-5">Disputa de devolución</h2>
                      
					@include('alerts.success')
  					@include('alerts.warning')

                    <div class="d-flex flex-column mb-5">
                        @foreach($comments as $comment)

                            <div class="media-return media-return--{{ $comment->IsBuyer ? 'buyer' : 'seller' }} mb-4">
                                <div class="media rounded p-3 mb-1">
                                    <div class="media-body">
                                        {{ $comment->Comment }}

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
                                <small>
                                    Enviado el {{ $comment->date }} | {{ $comment->IsBuyer ? 'Comprador:' : 'Vendedor:' }} 
                                    <a href="{{ url('user',$comment->alias) }}" class="green-link">{{ $comment->alias }}</a> 
                                </small>
                            </div>
                        @endforeach
                    </div>

                    <hr class="my-5">

                    <div class="row">
                        @if(Auth::User()->isAdmin() && !isset($return->Approved))

                            <form method="POST" action="{{ url('return',$return->ReturnID) }}" novalidate class="col-md-8 m-auto needs-validation">
                                @csrf
                                <p class="mb-4 text-center h5">Evaluar disputa</p>
                                <div class="form-group mb-4">
                                    <div class="d-flex align-top">
                                        <input class="switch-checkbox" type="checkbox" name="Approved" id="Approved" value="1"/>
                                        <label for="Approved" class="switch-label m-0"></label>
                                        <span class="ml-2 d-flex align-items-center"> Aceptar devolución</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Comment">Comentario</label>
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

                        @elseif(!Auth::User()->isAdmin() && !isset($return->Approved))
                            <form method="POST" action="{{ url('answer-comment',$return->ReturnID) }}" enctype="multipart/form-data"  novalidate class="col-md-8 m-auto needs-validation">
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
                        @endif
                    </div>
				</div>
			</div>
		</div>
	</main>
    <modal-gallery></modal-gallery>
@endsection
