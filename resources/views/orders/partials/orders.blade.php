@if(count($orders) == 0)
	<p>No tienes pedidos realizados.</p>
@else

	<p>Tienes {{ count($orders) }} pedido{{ count($orders) > 1 ? 's' : '' }} realizado{{ count($orders) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
			@foreach($orders as $order)
	      		@foreach($items[$order->OrderID] as $item)

	      			<li class="list-group-item">
				  		<div class="row no-gutters">
						    <div class="col-md-3">
						      <img src="{{ url('storage/'.$item->ThumbPath) }}" class="card-img" alt="{{ $item->ItemDescription }}">
						    </div>
						    <div class="col-md-9">
						      	<div class="card-body">
						      		<h5 class="card-title">
									  	{{ $item->ItemDescription }}

									  	@if(isset($item->FolioID) && !$order->Name == 'Cancelado')
											<a href="{{ url( isset($item->GuideURL) ? $item->GuideURL : '#' ) }}" class="btn btn-outline-green btn-sm float-right d-none d-sm-block" role="button" aria-pressed="true">
												Rastrear pedido
											</a>
										@endif
									</h5>

						      		<span class="badge mb-3 {{ $order->Name == 'Cancelado' ? 'badge-danger' : 'badge-warning' }} ">{{ $order->Name }}</span>
									<p>
										<small>No. Orden: {{ $item->NoOrder }}</small><br>

										@if(isset($item->FolioID) && !$order->Name == 'Cancelado')
											<small>No. Guía: {{ $item->FolioID }}</small><br>
										@endif
									</p>
									<p>
										<small>Talla: {{ $item->SizeID }}</small> <br>
										<small>Marca: {{ $item->BrandID }}</small> <br>
										<small>Vendedor:  <a class="green-link" href="{{ url('seller/'.$item->Alias) }}">{{ $item->Alias }}</a></small> <br>
									</p>
									@if($order->Name == 'Solicitado')
										<p>
											<small>
												<cancel-order 
													order="{{ $item->NoOrder }}"
													class="text-danger cursor-pointer"
												>Cancelar pedido
												<cancel-order/>
											</small>
										</p>
									@endif

									<a href="{{ url( isset($item->GuideURL) ? $item->GuideURL : '#' ) }}" class="btn btn-outline-green btn-sm d-block d-sm-none" role="button" aria-pressed="true">Rastrear pedido</a>

						      </div>
						    </div>
						</div>
			  		</li>

	      		@endforeach
      		@endforeach
		</ul>
	</div>	
			
@endif