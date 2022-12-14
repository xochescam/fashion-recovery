@if(count($canceled) == 0)
	<p>No hemos encontrado ninguna venta cancelada.</p>
@else

	<p>Tienes {{ count($canceled) }} venta{{ count($canceled) > 1 ? 's' : '' }} cancelada{{ count($canceled) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
		  @foreach($canceled as $order)
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
									  		<a href="{{ url('tracking',$order->PackingOrderID) }}" class="btn btn-outline-green btn-sm float-lg-right d-block d-lg-inline mt-2 mt-lg-0" role="button" aria-pressed="true">
											  Rastrear pedido
											</a>
									  	@endif
									</h5>

									<span class="green-color">{{ $order->ActualPrice }} </span><br>
									<p class="badge badge-danger mt-3">{{ $order->Name }} el {{ $order->update }}</p> 

									<p>
										<small>No. Orden: {{ $order->NoOrder }}</small><br>

										@if($order->FolioID)
											<small>No. Guía: {{ $order->FolioID }} <a class="green-link" href="{{ 'http://'.$order->GuideURL }}" target="_blank" rel="noopener noreferrer" >Descargar</a> </small> 
										@endif
									</p>
									<p>
										<small>
											Comprador:  
											<a href="{{ url('user',$order->Buyer) }}" class="green-link">
												{{ $order->Buyer }}
											</a>
										</small> <br>
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