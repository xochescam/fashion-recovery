@if(count($pending) == 0)
	<p>¿Buscas alguna venta? Se han enviado todos los pedidos.</p>
@else
 	<p>Tienes {{ count($pending) }} venta{{ count($pending) > 1 ? 's' : '' }} realizada{{ count($pending) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
		  @foreach($pending as $order)
	      			<li class="list-group-item">
				  		<div class="row no-gutters">
						    <div class="col-md-3">
						      <img src="{{ url('storage/'.$order->ThumbPath) }}" class="card-img" alt="{{ $order->ItemDescription }}">
						    </div>
						    <div class="col-md-9">
						      	<div class="card-body">
						      		<h5 class="card-title">
									  	{{ $order->ItemDescription }}

									 	@if($order->FolioID)
									  		<a href="{{ 'http://'.$order->GuideURL }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-green btn-sm float-right d-none d-sm-block" role="button" aria-pressed="true">Rastrear pedido</a>
									  	@endif
									</h5>

									<span class="green-color">{{ $order->ActualPrice }} </span><br>
									<p class="badge badge-warning mt-3">{{ $order->Name }} el {{ $order->update }}</p> 

									<p>
										<small>No. Orden: {{ $order->NoOrder }}</small><br>

										@if($order->FolioID)
											<small>No. Guía: {{ $order->FolioID }} <a class="green-link" href="https://envios-nacionales-api.herokuapp.com/downloads/pdf/sendex/{{ $order->GuideID }}">Descargar</a> </small> 
										@endif
									</p>
									<p>
										<small>
											Comprador:  
											<a href="{{ url('user',$order->Buyer) }}" class="green-link">
												{{ $order->Buyer }}
											</a>
										</small> <br>
										<small>Ganancia: ${{ $order->Gain }}</small> <br>
										<small>Fecha de compra: {{ $order->CreationDate }}</small> <br>
									</p>
						      </div>
						    </div>
						
						</div>
			  		</li>
      		@endforeach
		</ul>
	</div>	
			
@endif