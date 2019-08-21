@extends('layout.master')

@section('content')

	<main id="main">
      	<div class="container py-5">

      		@include('alerts.success')
  			@include('alerts.warning')

	        <div class="row">

	          	<div class="col-sm-8 d-flex mb-5">

		          	<div class="col-sm-2 p-0 mb-4 container-img-thumbs">
		          		@foreach($items as $item)
			                <div class="p-0 mb-4 thumb-img-public js-thumb-image" data-name="{{ 'storage/'.$item->PicturePath }}">
			                    <img src="{{ url('storage/'.$item->ThumbPath) }}" class="card-img-top alt="...">
			                </div>
			              @endforeach
		          	</div>
		            <div class="col-sm-10 container-img">
		            	<div class="card">
		            		<img class="js-card-image w-100" src="{{ url('storage/'.$items->first()->PicturePath) }}" alt="...">
		            	</div>
		            </div>

					<div class="container-img-slide w-100">
			            <div id="items-silide" class="carousel mb-3 ">
		                    <div class="carousel-inner">
		                    	@foreach($items as $item)
			                    	<div class="carousel-item {{ $item->ItemPictureID == $items->first()->ItemPictureID ? 'active' : ''  }}">
				                        <img class=" w-100" src="{{ url('storage/'.$item->PicturePath) }}" alt="...">
				                      </div>
		                    	@endforeach

		                    </div>
		                    <a class="carousel-control-prev" href="#items-silide" role="button" data-slide="prev">
		                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		                      <span class="sr-only">Previous</span>
		                    </a>
		                    <a class="carousel-control-next" href="#items-silide" role="button" data-slide="next">
		                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
		                      <span class="sr-only">Next</span>
		                    </a>
		                 </div>
		          	</div>
	          	</div>

	          	<div class="col-sm-4 mb-5">

					<h4>
						{{ $itemInfo->ItemDescription }} ({{ $itemInfo->TypeName }})
					</h4>

 					<p>por <a href=" {{ url('seller',$itemInfo->Alias) }} " class="green-link">{{ $itemInfo->Alias }}</a></p>

					<hr>

					<p>Precio original: <small class="line-through">${{ $itemInfo->OriginalPrice }}</small> </p>

					@if($itemInfo->OffSaleID !== null)
						<p>Oferta: <span class="badge badge-pill badge-danger">{{ $discount }}%</span></p>
					@endif

					<p>Precio actual: <span class="green-color">${{ $itemInfo->ActualPrice }}</span> </p>

					@if($itemInfo->OffSaleID !== null)
						<p>Precio con oferta: <span class="green-color"> <b>${{ $priceOffer }}</b></span> </p>
					@endif

					<table class="table table-borderless ">
					  	<tbody>
						    <tr>
						      <th scope="row" class="px-0 py-1">
						      	<small>Departamento:</small>
						      </th>
						      <td class="px-0 py-1">{{ $itemInfo->DepName }}</td>
						    </tr>
						    <tr>
						      <th scope="row" class="px-0 py-1">
						      	<small>Categoría:</small>
						      </th>
						      <td class="px-0 py-1">{{ $itemInfo->CategoryName }}</td>
						    </tr>
						    <tr>
						      <th scope="row" class="px-0 py-1">
						      	<small>Marca:</small>
						      </th>
						      <td colspan="2" class="px-0 py-1">

						      	@if(isset($otherBrand->OtherBrand))
									<a href="{{ url('/search?criteria='.$otherBrand->OtherBrand) }}" class="green-link">{{ $otherBrand->OtherBrand }}</a>
						      	@else
						      		<a href="{{ url('search/brand/'.$brand->BrandID) }}" class="green-link">{{ $brand->BrandName }}</a>
						      	@endif

						      </td>
					    	</tr>
					    	<tr>
						      <th scope="row" class="px-0 py-1">
						      	<small>Tipo de ropa:</small>
						      </th>
						      <td class="px-0 py-1">{{ isset($otherBrand->OtherClothingType) ? $otherBrand->OtherClothingType : $clothingType}}</td>
					    	</tr>
					    	<tr>
						      <th scope="row" class="px-0 py-1">
						      	<small>Talla:</small>
						      </th>
						      <td class="px-0 py-1">{{ isset($otherBrand->OtherSize) ? $otherBrand->OtherSize : $size}}</td>
					    	</tr>
					    	<tr>
						      	<th scope="row" class="px-0 py-1">
						      		<small>Estilo:</small>
						      	</th>
						      	<td class="px-0 py-1">
							      	<a href="{{ url('search/style/'.$itemInfo->ClothingStyleID) }}" class="green-link">
										{{ $itemInfo->ClothingStyleName }}
									</a>
								</td>
					    	</tr>
					    	<tr>
						      <th scope="row" class="px-0 py-2">
						      	<small>Color:</small>
						      </th>
						      <td class="px-0 py-2">{{ $itemInfo->ColorName}}</td>
					    	</tr>
					  	</tbody>
					</table>


					<div class="card w-100">
		          		<div class="card-body">
		          			<button class="btn btn-fr mb-3 w-100 ">
		          				Comprar
		          			</button>
		          			<a href="{{ url('add-to-cart',$itemInfo->ItemID) }}" class="btn btn-fr mb-3 w-100 ">
		          				<i class="fas fa-shopping-cart mr-1"></i>
		          				 Agregar al carrito
		          			</a>

		          			<div class="dropdown">
							  <button class="btn green-border-button w-100 btn-outline-light my-2 my-sm-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							  	<i class="fas fa-heart mr-1"></i>
								 Agregar a wishlist
							  </button>
							  <div class="dropdown-menu w-100 " aria-labelledby="dropdownMenuButton">

							  	@if(Auth::User())
							  		@foreach($wishlists as $wishlist)
							    		<a class="dropdown-item text-left" href="{{ url('wishlist/'.$wishlist->WishListID.'/'.$id.'/exists') }}"> {{ $wishlist->NameList }} </a>
							    	@endforeach
							    @endif
							    <a class="dropdown-item dropdown-item--green text-left green-color" href="#" data-toggle="modal" data-target="#addWishlist">
							    	<i class="fas fa-plus"></i>
									<b class="ml-1" >Nueva wishlist</b>
								</a>
							  </div>
							</div>
		          		</div>
		          	</div>
	          	</div>

	          	<div class="col-sm-8 col-12 mt-5">
					<h5>Preguntas y respuestas</h5>

            		<form method="POST" action="{{ url('question') }}" class="needs-validation my-5" novalidate>
            			@csrf

            			<input type="hidden" name="id" value="{{ $id }}">

						<div class="form-group">
						    <label for="question">¿Tienes una pregunta?</label>
						    <textarea class="form-control" name="question" id="question" rows="2" required></textarea>

						    @if ($errors->has('question'))
			                    <div class="invalid-validation">
			                      {{ $errors->first('question') }}
			                    </div>
			                @else
			                    <div class="invalid-feedback">
			                      Ingresa una pregunta.
			                    </div>
			                @endif

						</div>
					  	<button type="submit" class="btn btn-fr">Preguntar</button>
					</form>

					@include('item.partials.question-parent')

				</div>

	        </div>
      	</div>
    </main>

    <!-- Modal -->
    @include('wishlist.create')

@endsection
