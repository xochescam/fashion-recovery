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
@endsection
