@extends('layout.master')

@section('content')

	<main id="main">
      	<div class="container py-5">


		@include('alerts.warning')

		<div class="alert alert-warning alert-dismissible d-none mb-3" role="alert">
			<span></span>
		<!-- 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button> -->
		</div>

		<div class="alert alert-success alert-dismissible d-none mb-3" role="alert">
			<span></span>
		<!-- 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button> -->
		</div>

	        <div class="row ">

	          	<div class="col-sm-8 d-flex mb-5">

		          	<div class="col-sm-2 p-0 mb-4 container-img-thumbs">
		          		@foreach($items as $item)
			                <div class="p-0 mb-4 thumb-img-public js-thumb-image" data-name="{{ 'storage/'.$item->PicturePath }}">
			                    <img src="{{ url('storage/'.$item->ThumbPath) }}" class="card-img-top">
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
						{{ $info->ItemDescription }} ({{ $info->TypeName }})
					</h4>

 					<p>por <a href=" {{ url('seller',$info->Alias) }} " class="green-link">{{ $info->Alias }}</a></p>

					<hr>

					<p>Precio original: <small class="line-through">{{ $info->OriginalPrice }}</small> </p>

					<p>Precio actual: <span class="green-color">{{ $info->ActualPrice }}</span> </p>

					@if($info->OffSaleID !== null)
						<p>Oferta: 
						<span class="badge badge-danger">
                      		{{ $discount }} %
						</span>
					
<!-- 					<span class="badge badge-pill badge-danger">{{ $discount }}%</span>
 -->				</p>
					@endif

					@if($info->OffSaleID !== null)
						<p>Precio con oferta: <span class="green-color"> <b>${{ $priceOffer }}</b></span> </p>
					@endif

					<table class="table table-borderless ">
					  	<tbody>
						    <tr>
						      <th scope="row" class="px-0 py-1">
						      	<small>Departamento:</small>
						      </th>
						      <td class="px-0 py-1">{{ $info->DepName }}</td>
						    </tr>
						    <tr>
						      <th scope="row" class="px-0 py-1">
						      	<small>Categoría:</small>
						      </th>
						      <td class="px-0 py-1">{{ $info->CategoryName }}</td>
						    </tr>
						    <tr>
						      <th scope="row" class="px-0 py-1">
						      	<small>Marca:</small>
						      </th>
						      <td colspan="2" class="px-0 py-1">

								@if($info->OtherBrand)
									{{ $info->BrandName }}
								@else
									<a href="{{ url('search/brands/'.$info->BrandName) }}" class="green-link">{{ $info->BrandName }}</a>
								@endif

						      </td>
					    	</tr>
					    	<tr>
						      <th scope="row" class="px-0 py-1">
						      	<small>Tipo de ropa:</small>
						      </th>
						      <td class="px-0 py-1">{{ $info->ClothingTypeName }}</td>
					    	</tr>
					    	<tr>
						      <th scope="row" class="px-0 py-1">
						      	<small>Talla:</small>
						      </th>
						      <td class="px-0 py-1">{{ $info->SizeName }}</td>
					    	</tr>
					    	<tr>
						      <th scope="row" class="px-0 py-2">
						      	<small>Color:</small>
						      </th>
						      <td class="px-0 py-2">{{ $info->ColorName}}</td>
					    	</tr>
					  	</tbody>
					</table>

					<div class="card w-100">
		          		<div class="card-body">
		          			<a href="{{ url('payment/'.$info->ItemID.'/true') }}" class="btn btn-fr my-2 w-100">
		          				Comprar
		          			</a>
							<item-to-shopping-cart
								item_id="{{ $info->ItemID }}"
								url="{{ isset(Auth::User()->id) }}"
								in_cart="{{ isset(Auth::User()->id) ? Auth::User()->inCart($info->ItemID) : 0 }}"
								>
							</item-to-shopping-cart>
							  
							<heart-wishlist-component
								has="{{ Auth::User() && isset( Auth::User()->inWishlist($item->ItemID)->WishlistID ) > 0 ? true : false }}"
								url="{{ $urlWishlists }}"
								type="full"
							></heart-wishlist-component>

							</div>
		          		</div>
		          	</div>
	          	</div>

				@can('create-comments' || 'answer-comments')
					<question
						:item="{{ $item->ItemID }}"
						:errors="{{ $errors }}"
						:questions="{{ $questions }}"
						:auth="{{ isset(Auth::User()->id) ? 'true' : 'false' }}"
					></question>
				@endcan
	        </div>
      	</div>
    </main>

@endsection
