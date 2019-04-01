@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
	        		
					<div class="row">
					  <div class="col-sm-6">
					    <div class="card">
					      <div class="card-body">
					        <h5 class="card-title">Closets</h5>
					        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
					        <a href="{{ url('closets') }}" class="btn btn-fr">Ver</a>
					      </div>
					    </div>
					  </div>
					  <div class="col-sm-6">
					    <div class="card">
					      <div class="card-body">
					        <h5 class="card-title">Prendas</h5>
					        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
					        <a href="{{ url('items') }}" class="btn btn-fr">Ver</a>
					      </div>
					    </div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection
