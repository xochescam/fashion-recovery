@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
        	<h2 class="text-center TituloFR my-4 mb-6">¡Tu pedido esta en camino!</h2>

			<div class="col-md-10 m-auto">
				<ul class="tracking mt-5">
					@foreach($tracking as $track)
						<li class="tracking__place mb-5">
							<span 
								class="tracking__dot {{ $track['status'] === 'Destino' ? 'tracking__dot--gray' : ($tracking[count($tracking) - 2]['location'] === $track['location'] ? 'tracking__dot--penultimate' : '') }}"></span>
							<p class="mb-0"> 
								{{ $track['status'] }} 
								<br>
								<small> 
									{{ $track['location'] === '' ? $tracking[0]['location'] :  $track['location']  }} 
									{{ isset($track['date']) ?  'el '.$track['date'] : '' }} 
								</small>	
							</p>
						</li>
					@endforeach
				</ul>
			</div>
        </div>
    </main>
@endsection
