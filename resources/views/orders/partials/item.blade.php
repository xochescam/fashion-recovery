<li class="list-group-item py-0">
	<div class="row no-gutters">
		<div class="col-md-3">
			<img src="{{ url('storage/'.$item->ThumbPath) }}" class="card-img" alt="{{ $item->ItemDescription }}">
		</div>
		<div class="col-md-9">
			<div class="card-body">

				<div class="d-md-flex">
					<h5 class="card-title card-title--max">
						{{ $item->ItemDescription }}
					</h5>

					<div class="card-title-options">
						@if(isset($item->FolioID) && $order->Name !== 'Cancelado' && $order->Name !== 'Entregado' && $order->Name !== 'Confirmado')
							<a href="{{ url('tracking',$item->PackingOrderID) }}" class="btn btn-outline-green btn-sm float-lg-right d-block d-lg-inline mt-2 mt-lg-0" role="button" aria-pressed="true">
								Rastrear pedido
							</a>

						@elseif(isset($item->FolioID) && $order->Name === 'Entregado')
							<btn-rating-modal
								order="{{ $item->NoOrder }}"
								text="Evalua tu experiencia"
							></btn-rating-modal>

							@if($item->isTime && !$item->IsReturn)
								<small class="mt-2 text-center">
									<a href="{{ url('return',$item->NoOrder ) }}" class="green-link"> Solicitar devolución</a>
								</small>
							@endif
						@endif
					</div>		
				</div>
								
				<span class="green-color">{{ $item->ActualPrice }}</span><br>

				@if($item->IsReturn)
					<span class="badge mb-3 mt-3 {{ $order->Name == 'Cancelado' ? 'badge-danger' : ($order->Name == 'Entregado' || $order->Name == 'Confirmado' ? 'badge-success' : 'badge-warning') }} ">
						{{ $order->Name == 'Devuelto' ? 'Devolución confirmada' : $order->Name }} el {{ $item->update }}
					</span>
				@else
					<span class="badge mb-3 mt-3 {{ $order->Name == 'Cancelado' ? 'badge-danger' : ($order->Name == 'Entregado' || $order->Name == 'Confirmado' ? 'badge-success' : 'badge-warning') }} ">
						{{ $order->Name }} el {{ $item->update }}
					</span>
				@endif
				
									
				<p>
					<small>No. Orden: {{ $item->NoOrder }}</small><br>

					@if(isset($item->FolioID) && $order->Name !== 'Cancelado')
						<small>
							No. Guía: {{ $item->FolioID }}

							@if($item->IsReturn)
								<a class="green-link" href="{{ 'http://'.$item->GuideURL }}" target="_blank" rel="noopener noreferrer" >Descargar</a>
							@endif
						</small><br>
					@endif
				</p>

				<p class="mb-0">
					<small>Talla: {{ $item->SizeID }}</small> <br>
					<small>Marca: {{ $item->BrandID }}</small> <br>
					<small>Vendedor:  <a class="green-link" href="{{ url('user/'.$item->Alias) }}">{{ $item->Alias }}</a></small> <br>
					<small>Fecha de compra: {{ $item->CreationDate }}</small> <br>
				</p>

				<!--@if($order->Name == 'Solicitado')
					<p>
						<small>
							<cancel-order 
								order="{{ $item->NoOrder }}"
								class="text-danger cursor-pointer"
								>Cancelar pedido
							<cancel-order/>
						</small>
					</p>
				@endif -->

			</div>
		</div>
	</div>
</li>