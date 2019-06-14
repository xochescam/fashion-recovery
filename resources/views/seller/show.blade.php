@extends('layout.master')

@section('content')

   <main id="main">
        <div class="container py-5">
          <div class="row">
            <div class="col-sm-8 d-flex">

              <div class="col-sm-2 p-0 mb-4 container-img-thumbs">
                @foreach($closets as $closet)
                    <div id="carousel_{{ $closet->ClosetID }}" class="carousel mb-3">
                      <div class="carousel-inner">
                        @foreach($items[$closet->ClosetID] as $item)
                          <div class="carousel-item {{ $item->ItemPictureID == $items[$closet->ClosetID][0]->ItemPictureID ? 'active' : ''  }}">

                            <div class="carousel-item">
                              <img src="{{ url('storage/'.$item->ThumbPath) }}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach

                      </div>
                      <a class="carousel-control-prev" href="#carousel_{{ $closet->ClosetID }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel_{{ $closet->ClosetID }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  @endforeach
              </div>

        <div class="container-img-slide w-100">
                <div id="items-silide" class="carousel mb-3 ">
                      <div class="carousel-inner">
                        {{-- @foreach($items as $item)
                          <div class="carousel-item {{ $item->ItemPictureID == $items->first()->ItemPictureID ? 'active' : ''  }}">
                              <img class=" w-100" src="{{ url('storage/'.$item->PicturePath) }}" alt="...">
                            </div>
                        @endforeach --}}

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

        <div class="col-sm-4">

          <h5>
            {{ $seller->Alias }}
          </h5>

          <div class="card card--selfie ">
{{--             <img src=" {{ url($seller->SelfieThumbPath) }} " class="card-img-top js-selfie-img" alt=""> --}}
            <img src="http://fashionrecovery.azurewebsites.net/storage/sellers/103/thumb-20190530-190925_103_selfie.jpg" class="card-img-top js-selfie-img" alt="">

            
            <i class="far fa-edit" id="edit_icon"></i>
          </div>

          <p> {{ $seller->Greeting }}</p>

          <hr>

          <p> {{ $seller->AboutMe }} </p>

          <table class="table table-borderless ">
              <tbody>
                <tr>
                  <th scope="row" class="px-0 py-1">
                    <small>Vivo en:</small>
                  </th>
                  <td class="px-0 py-1">{{ $seller->LiveIn }}</td>
                </tr>
                <tr>
                  <th scope="row" class="px-0 py-1">
                    <small>Trabajo en:</small>
                  </th>
                  <td class="px-0 py-1">{{ $seller->WorkIn }}</td>

              </tbody>
          </table>

              </div>

            </div>

          </div>
        </div>
    </main>

@endsection
