@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
            <h2 class="text-center TituloFR my-4 mb-6">Evidencia del producto</h2>
            
        	<p class="mb-5 text-center w-100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda reiciendis blanditiis cum veniam iure corrupti, odit ipsum rem deleniti. Quisquam quidem eius fugiat sed eaque quo qui tempore, eum laborum.</p>

			<div class="col-md-8 m-auto">

                <form method="POST" action="{{ url('send-answer',$ReturnID) }}" class="needs-validation"  enctype="multipart/form-data"  novalidate>

                    @csrf

                    <return-photos
                        :errors="{{ $errors }}"
                        type="return"
                    >
                    </return-photos>
                    
                    <div class="form-group">
                        <label for="comments">Cuéntanos sobre la prenda</label>
                        <textarea class="form-control" id="comments" name="Comments" rows="4" required></textarea>
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
