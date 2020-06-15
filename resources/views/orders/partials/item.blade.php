<li class="list-group-item">
	<div class="row no-gutters">
		<div class="col-md-3">
			<img src="{{ url('storage/'.$item->ThumbPath) }}" class="card-img" alt="{{ $item->ItemDescription }}">
		</div>
		<div class="col-md-9">
			<div class="card-body">
				<h5 class="card-title">
					{{ $item->ItemDescription }}

					@if(isset($item->FolioID) && $order->Name !== 'Cancelado')
						<a href="{{ 'http://'.$item->TrackingURL }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-green btn-sm float-lg-right d-block d-lg-inline mt-2 mt-lg-0" role="button" aria-pressed="true">
							Rastrear pedido
						</a>
					@endif
				</h5>
									
				<span class="green-color">{{ $item->ActualPrice }}</span><br>
				<span class="badge mb-3 mt-3 {{ $order->Name == 'Cancelado' ? 'badge-danger' : ($order->Name == 'Entregado' ? 'badge-success' : 'badge-warning') }} ">
					{{ $order->Name }} el {{ $item->update }}
				</span>
									
				<p>
					<small>No. Orden: {{ $item->NoOrder }}</small><br>

					@if(isset($item->FolioID) && $order->Name !== 'Cancelado')
						<small>No. Guía: {{ $item->FolioID }}</small><br>
					@endif
				</p>

				<p>
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