@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
        	<h2 class="text-center TituloFR my-4 mb-6">¡Tu pedido esta en camino!</h2>

			<div class="col-md-10 m-auto">
				<ul class="mt-5">
					@foreach($tracking as $track)
						<li class="mb-5">
							<p class="mb-0"> {{ $track['status'] }} </p>
							
							<small> 
								{{ $track['location'] === '' ? $tracking[0]['location'] :  $track['location']  }} 
								{{ isset($track['date']) ?  'el '.$track['date'] : '' }} 
							</small>
						</li>
					@endforeach
				</ul>
			</div>
        </div>
    </main>
@endsection
