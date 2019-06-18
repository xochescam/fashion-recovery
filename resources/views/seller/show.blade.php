@extends('layout.master')

@section('content')

   <main id="main">
        <div class="container py-5">
          <div class="row">

            <div class="col-sm-4">
              <div class="card mb-5">
                <div class="card-body">

                  <div class="card card--selfie">
                    <img src="{{ url($seller->SelfieThumbPath) }}" class="card-img-top js-selfie-img" alt="">
                  </div>

                  <hr class="my-5">

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
                    </tbody>
                </table>

                <hr class="my-5">

                <p><i class="fas fa-check green-color mr-1"></i>  Documento de identificación </p>
                </div>
              </div>

            </div>

            <div class="col-sm-8">
              <h2> {{ $seller->Greeting }} </h2>
              <small>Miembro desde {{ $sellerSince }}</small>

              <hr class="my-5">

              <p> {{ $seller->AboutMe }} </p>

              <p>Vive en {{ $seller->LiveIn }}</p>

              <hr class="my-5">

              <h5 class="mb-5">{{ $seller->TotalEvaluations  }} evaluaciones</h5>

              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <div class="media">
                    <img src="{{ url('https://via.placeholder.com/64.png') }}" class="mr-3" alt="...">
                    <div class="media-body">
                      <h5 class="mt-0">Username</h5>
                      Nulla vel metus scelerisque ante sollicitudin.
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="media">
                    <img src="{{ url('https://via.placeholder.com/64.png') }}" class="mr-3" alt="...">
                    <div class="media-body">
                      <h5 class="mt-0">Username</h5>
                      Donec lacinia congue felis in faucibus.
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="media">
                    <img src="{{ url('https://via.placeholder.com/64.png') }}" class="mr-3" alt="...">
                    <div class="media-body">
                      <h5 class="mt-0">Username</h5>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="media">
                    <img src="{{ url('https://via.placeholder.com/64.png') }}" class="mr-3" alt="...">
                    <div class="media-body">
                      <h5 class="mt-0">Username</h5>
                      Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="media">
                    <img src="{{ url('https://via.placeholder.com/64.png') }}" class="mr-3" alt="...">
                    <div class="media-body">
                      <h5 class="mt-0">Username</h5>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </main>

@endsection
