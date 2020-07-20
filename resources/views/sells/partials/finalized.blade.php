@if(count($finalized) == 0)
	<p>Ha finalizado el curso de todas tus ventas.</p>
@else
	
	<p>Tienes {{ count($finalized) }} venta{{ count($finalized) > 1 ? 's' : '' }} finalizada{{ count($finalized) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
		  @foreach($finalized as $order)
	      			<li class="list-group-item">
				  		<div class="row no-gutters">
						    <div class="col-md-3">
						      <img src="{{ url('storage/'.$order->ThumbPath) }}" class="card-img" alt="{{ $order->ItemDescription }}">
						    </div>
						    <div class="col-md-9">
						      	<div class="card-body">
								  	<div class="d-md-flex">
										<h5 class="card-title card-title--max">
											{{ $order->ItemDescription }}
										</h5>
										
										<div class="card-title-options">
											@if($order->FolioID && $order->Name === 'Confirmado')
												<button type="button" class="btn btn-fr btn-sm d-block float-lg-right d-block d-lg-inline mt-2 mt-lg-0" data-toggle="modal" data-target="#modal-{{ $order->ItemID }}">
													Ver evaluación
												</button>
											@elseif($order->FolioID)
												<a href="{{ url('tracking',$order->PackingOrderID) }}" class="btn btn-outline-green btn-sm float-lg-right d-block d-lg-inline mt-2 mt-lg-0" role="button" aria-pressed="true">
													Rastrear pedido
												</a>

												@if($order->ReturnID)
													<small class="mt-2 text-center">
														<a href="{{ url('comments-return/'.$order->ReturnID.'/false') }}" class="green-link">Proceso de devolución</a>
													</small>
												@endif
											@endif
										</div>
									</div>
									

									<span class="green-color">{{ $order->ActualPrice }} </span><br>
									<p class="badge badge-success mt-3">{{ $order->Name }} el {{ $order->update }}</p> 

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
