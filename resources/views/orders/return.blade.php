@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
            <h2 class="text-center TituloFR my-4 mb-6">¿Cuál es el motivo de tu devolución?</h2>
            
        	<p class="mb-5 text-center w-100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda reiciendis blanditiis cum veniam iure corrupti, odit ipsum rem deleniti. Quisquam quidem eius fugiat sed eaque quo qui tempore, eum laborum.</p>

			<div class="col-md-8 m-auto">

                <form method="POST" action="{{ url('send-return',$NoOrder) }}" class="needs-validation"  enctype="multipart/form-data"  novalidate>

                    @csrf

                    <div class="form-group">
                        <label for="RasonID">Motivo de devolución</label>
                        <select class="custom-select" name="RasonID" id="RasonID" required>
                            <option value="">Seleccionar</option>

                            @foreach($rasons as $rason)
                                <option value="{{ $rason->RasonID }}">{{ $rason->Rason }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('RasonID'))
                            <div class="invalid-feedback">
                            {{ $errors->first('RasonID') }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                El campo es obligatorio.
                            </div>
                        @endif

                    </div>

                    <return-photos
                        :errors="{{ $errors }}"
                        type="return"
                    >
                    </return-photos>
                    
                    <div class="form-group">
                        <label for="comments">Cuéntanos sobre el problema</label>
                        <textarea class="form-control" id="comments" name="Comments" rows="4"></textarea>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-fr">
                            <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                            Enviar
                        </button>
                    </div>
                </form>

			</div>
        </div>
    </main>
@endsection
