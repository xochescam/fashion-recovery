@if(count($sells) == 0)
	<p>No tienes ventas realizadas.</p>
@else

	<p>Tienes {{ count($sells) }} venta{{ count($sells) > 1 ? 's' : '' }} realizada{{ count($sells) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
			@foreach($sells as $order)
	      		{{-- @foreach($sells[$order->OrderID] as $item) --}}

	      			<li class="list-group-item">
				  		<div class="row no-gutters">
						    <div class="col-md-3">
						      <img src="{{ url('storage/'.$order->ThumbPath) }}" class="card-img" alt="{{ $order->ItemDescription }}">
						    </div>
						    <div class="col-md-9">
						      	<div class="card-body">
						      		<h5 class="card-title">
									  {{ $order->ItemDescription }}
									  <a href="{{ url( isset($item->GuideURL) ? $item->GuideURL : '#' ) }}" class="btn btn-outline-green btn-sm float-right d-none d-sm-block" role="button" aria-pressed="true">Rastrear pedido</a>
									</h5>

									<span class="green-color">{{ $order->ActualPrice }}</span><br>
									<p class="badge badge-warning mt-3">{{ $order->Name }}</p> 

									<p>
										<small>No. Orden: {{ $order->NoOrder }}</small><br>
										<small>No. Guía: {{ $order->FolioID }} <a class="green-link" href="#">Descargar</a> </small> 
									</p>
									<p>
										<small>Comprador: {{ $order->Buyer }}</small> <br>
										<small>Ganancia: $96.60</small> <br>
										<small>Fecha: {{ $order->CreationDate }}</small> <br>
									</p>
						      </div>
						    </div>
						    
							<div class="col-md-3">
							    <!-- <form method="GET" action="{{ url('sell/'.$order->OrderID.'/update') }}" class="form" class="was-validated">
							    	<div class="form-group">
									    <label for="exampleFormControlSelect1">Estado de la venta</label>
									    <select class="form-control" id="OrderID" name="OrderID" required>
									      <option value="">- Seleccionar -</option>
									      <option value="2">Enviado</option>
									      <option value="3">En transito</option>
									      <option value="5">Devuelto</option>
									    </select>

									    @if ($errors->has('OrderID'))
									      <div class="invalid-validation">
									        {{ $errors->first('OrderID') }}
									      </div>
									    @else
									      <div class="invalid-feedback">
									        Selecciona un estado de la venta.
									      </div>
									    @endif

									    <button class="btn btn-fr w-100 mt-4" >Actualizar</a>							    			
							    	</div>
						    	</form> -->
							</div>
						</div>
			  		</li>

	      		{{-- @endforeach --}}
      		@endforeach
		</ul>
	</div>	
			
@endif