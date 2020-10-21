@extends('dashboard.master')

@section('content')

	<main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          	<h2 class="text-center TituloFR my-4">Usuarios</h2>

					    @include('alerts.success')
  					  @include('alerts.warning')

              @include('users.partials.users')
				</div>
			</div>
		</div>
	</main>

<!-- Modal -->
<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transferModalLabel">Transferir</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" class="transfer-form" class="needs-validation"  enctype="multipart/form-data">
            @csrf

            <return-photos
                :errors="{}"
                type="transfer"
            >
            </return-photos>

            <div class="text-center mt-5 mb-2">
				  <button type="submit" class="btn btn-fr m-auto">Enviar</button>
			</div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
