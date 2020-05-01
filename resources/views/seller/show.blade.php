@extends('layout.master')

@section('content')

   <main id="main">
        <div class="container py-5">
          
          @include('alerts.success')
          @include('alerts.warning')

          <div class="row">

            <div class="col-md-4">
              <div class="card mb-5">
                
                <h2 class="mt-4 text-center"> {{ $seller->Alias }} </h2>

                <div class="card-body">

                  <div class="card card--selfie mx-auto">
                    <img src="{{ url($seller->SelfieThumbPath) }}" class="card-img-top js-selfie-img" alt="">

                  </div>
                  <div class="text-center mt-3 w-100">
                     <a href="{{ url('follow',$seller->id) }}" class="btn btn-fr btn-sm {{ $isFollower ? 'hidden' : '' }}">
                        <i class="fas fa-plus pr-1"></i> Seguir  
                    </a>

                    <div class="btn-group {{ $isFollower ? '' : 'hidden' }} " role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-check pr-1"></i> Siguiendo
                      </button>
                      <div class="dropdown-menu btn-sm p-0" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item btn-sm" href="{{ url('unfollow',$seller->id) }}">Dejar de seguir</a>
                      </div>
                    </div>
                  </div>


                  <hr class="my-4">

                  <table class="table table-borderless ">
                    <tbody>
                      <tr>
                        <th scope="row" class="px-0 py-1">
                          <small>Ranking:</small>
                        </th>
                        <td class="px-0 py-1">
                          <div class="text-left">
                            <i class="fas fa-star yellow"></i>
                            <i class="fas fa-star yellow"></i>
                            <i class="fas fa-star yellow"></i>
                            <i class="far fa-star gray"></i>
                            <i class="far fa-star gray"></i>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="px-0 py-1">
                          <small>Total de evaluaciones:</small>
                        </th>
                        <td class="px-0 py-1">{{ $seller->TotalEvaluations  }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="px-0 py-1">
                          <small>Prendas vendidas:</small>
                        </th>
                        <td class="px-0 py-1">{{ $seller->ItemsSold }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="px-0 py-1">
                          <small>Devoluciones:</small>
                        </th>
                        <td class="px-0 py-1">{{ $seller->ItemsReturned  }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="px-0 py-1">
                          <small>Prendas en el guardarropa:</small>
                        </th>
                        <td class="px-0 py-1">{{ count($items)  }}</td>
                      </tr>
                    </tbody>
                </table>

                <hr class="my-4">

                <p><i class="fas fa-check green-color mr-1"></i>  Documento de identificación </p>
                </div>
              </div>

            </div>

            <div class="col-md-8">

              <h3> {{ $seller->Greeting }} </h3>
              <small>Miembro desde {{ $sellerSince }}</small>

              <hr class="my-4">

              <p> {{ $seller->AboutMe }} </p>

              <p>Vive en {{ $seller->LiveIn }}</p>

              <hr class="my-4">

              <h5 class="mb-5">{{ $seller->TotalEvaluations  }} evaluaciones</h5>

              <hr class="my-4">

              <div class="d-flex align-content-center flex-wrap">
                @foreach($items as $item)
                  <a href="{{ url('items/'.$item->ItemID.'/public') }}" class="img-thumb">
                    <img src="{{ url('storage/'.$item->ThumbPath) }}" class="rounded">
                  </a>
                @endforeach
              </div>
            
            </div>
          </div>
        </div>
    </main>

@endsection
