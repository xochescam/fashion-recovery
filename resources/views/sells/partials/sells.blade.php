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
						    <div class="col-md-6">
						      	<div class="card-body">
						      		<h5 class="card-title">{{ $order->ItemDescription }}</h5>
						      		<span class="badge badge-warning mb-3">{{ $order->Name }}</span>
						      	<p>
						      		<small>Talla: {{ $order->SizeID }}</small> <br>
						      		<small>Marca: {{ $order->BrandID }}</small>
						      	</p>
						      </div>
						    </div>
						    
							<div class="col-md-3">
							    <form method="GET" action="{{ url('sell/'.$order->OrderID.'/update') }}" class="form" class="was-validated">
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
						    	</form>
							</div>
						</div>
			  		</li>

	      		{{-- @endforeach --}}
      		@endforeach
		</ul>
	</div>	
			
@endif