@if(count($return) == 0)
	<p>¿Buscas alguna venta? Se han enviado todos los pedidos.</p>
@else
 	<p>Tienes {{ count($return) }} devoluci{{ count($return) > 1 ? 'ones' : 'ón' }} realizada{{ count($return) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
		  @foreach($return as $order)
	      			<li class="list-group-item">
				  		<div class="row no-gutters">
						    <div class="col-md-3">
						      <img src="{{ url('storage/'.$order->ThumbPath) }}" class="card-img" alt="{{ $order->ItemDescription }}">
						    </div>
						    <div class="col-md-9">
						      	<div class="card-body">
								   <div class="d-md-flex">
						      			<h5 class="card-title">
									  		{{ $order->ItemDescription }}
										</h5>

										<div class="card-title-options">
											@if($order->FolioID && $order->Name !== 'Devolución entregada' && $order->Name !== 'Devolución confirmada')
												<a href="{{ url('tracking',$order->PackingOrderID) }}" class="btn btn-outline-green btn-sm float-lg-right d-block d-lg-inline mt-2 mt-lg-0" role="button" aria-pressed="true">
												Rastrear pedido
												</a>

											@elseif($order->FolioID && $order->Name === 'Devolución entregada')
												<a href="{{ url('delivered-return',$order->OrderID) }}" class="btn btn-fr btn-sm float-lg-right d-block d-lg-inline mt-2 mt-lg-0" role="button" aria-pressed="true">
													Confirmar entrega
												</a> 

											@endif

											@if($order->ReturnID && $order->Name !== 'Devolución confirmada')
												<small class="mt-2 text-center">
													<a href="{{ url('comments-return/'.$order->ReturnID.'/false') }}" class="green-link">Proceso de devolución</a>
												</small>
											@endif
										</div>
									</div>
								
									<span class="green-color">{{ $order->ActualPrice }} </span><br>
									<p class="badge badge-{{ $order->Name === 'Devolución confirmada' || $order->Name === 'Devolución entregada' || $order->Name === 'Devuelto' ? 'success' : 'warning'}} mt-3">
										{{ $order->Name === 'Devuelto' ? 'Devolución aprobada' : $order->Name }}</p> 

									<p>
										<small>No. Orden: {{ $order->NoOrder }}</small><br>

										@if($order->FolioID)
											<small>No. Guía: {{ $order->FolioID }} </small> 
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