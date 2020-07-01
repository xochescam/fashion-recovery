@if(count($sells) == 0)
	<p>No tienes ventas realizadas.</p>
@else

	<p>Tienes {{ count($sells) }} venta{{ count($sells) > 1 ? 's' : '' }} realizada{{ count($sells) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
			@foreach($sells as $order)
	      			<li class="list-group-item">
				  		<div class="row no-gutters">
						    <div class="col-md-3">
						      <img src="{{ url('storage/'.$order->ThumbPath) }}" class="card-img" alt="{{ $order->ItemDescription }}">
						    </div>
						    <div class="col-md-9">
						      	<div class="card-body">
						      		<h5 class="card-title">
									  {{ $order->ItemDescription }}
									  <a href="{{ url('tracking',$order->PackingOrderID) }}" class="btn btn-outline-green btn-sm float-lg-right d-block d-lg-inline mt-2 mt-lg-0" role="button" aria-pressed="true">
									  	Rastrear pedido
									  </a>
									</h5>

									<span class="green-color">{{ $order->ActualPrice }}</span><br>
									<p class="badge badge-warning mt-3">{{ $order->Name }}</p> 

									<p>
										<small>No. Orden: {{ $order->NoOrder }}</small><br>

										@if($order->FolioID)
											<small>No. Guía: {{ $order->FolioID }} <a class="green-link" href="{{ 'http://'.$order->GuideURL }}" target="_blank" rel="noopener noreferrer" >Descargar</a> </small> 
										@endif
									</p>
									<p>
										<small>Comprador: {{ $order->Buyer }}</small> <br>
										<small>Ganancia: {{ $order->Gain }}</small> <br>
										<small>Fecha: {{ $order->CreationDate }}</small> <br>
									</p>
						      </div>
						    </div>
						
						</div>
			  		</li>
      		@endforeach
		</ul>
	</div>	
			
@endif