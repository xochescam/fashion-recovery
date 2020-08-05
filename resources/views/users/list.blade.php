@extends('dashboard.master')

@section('content')

	<main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	          		<h2 class="text-center TituloFR my-4">Usuarios</h2>

					@include('alerts.success')
  					@include('alerts.warning')


                        <ul class="nav nav-tabs flex-md-row flex-column p-0 m-auto orders-list" id="myTab" role="tablist">
                            <li class="nav-item px-md-0 px-4">
                                <a class="nav-link green-link active" id="buyers-tab" data-toggle="tab" href="#buyers" role="tab" aria-controls="buyers" aria-selected="true">
                                    Compradores ({{ count($users[1]) }})
                                </a>
                            </li>
                            <li class="nav-item px-md-0 px-4">
                                <a class="nav-link green-link" id="sellers-tab" data-toggle="tab" href="#sellers" role="tab" aria-controls="sellers" aria-selected="false">
                                    Vendedores ({{ count($users[2]) }})
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content m-auto" id="myTabContent">
                            <div class="tab-pane fade show mt-4 active" id="buyers" role="tabpanel" aria-labelledby="buyers-tab">
                                @include('users.partials.buyers')
                            </div>
                            <div class="tab-pane fade mt-4" id="sellers" role="tabpanel" aria-labelledby="sellers-tab">
                                @include('users.partials.sellers')
                            </div>
                        </div>
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
