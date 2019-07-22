<p>
    <span class="font-weight-bold">{{ $items->count() }}</span> de resultados para <span class="font-weight-bold">"{{ app('request')->input('criteria') !== null ? app('request')->input('criteria') : $search  }}"</span>
</p>

<div class="mb-5">
    <p class="text-right">
      <a class="btn btn-fr" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Filtrar resultados
      </a>
    </p>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            @include('search.filter')
        </div>
    </div>
</div>

{{-- <a href="#myModal" role="button" class="btn btn-fr" data-toggle="modal">Filtrar resultados</a> --}}

{{-- <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-full" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filtrar resultados</h5>
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body p-4" id="result">
                        @include('search.filter')
                    </div>
                </div>
            </div>
    </div> --}}

@if($items->count() > 0)
    <section id="resultadosBusqueda" class="mt-5">
        <div class="container-fluid">
            <div class="row shadow-lg p-3 mb-5 bg-white rounded">

                @foreach($items as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex">
                        <a href="{{ url('items/'.$item->ItemID.'/public') }}" class="link-card">
                            <div class="card card--public card--item shadow p-3 mb-5 bg-white rounded">
                                {{-- <img class="card-img-top" src="{{ url('storage',$itemsInfo[$item->ItemID]->first()->ThumbPath) }}" alt="Card image cap" height="200px;"> --}}
                                <div class="card-body">
                                    <div class="badges float-right">
                                        <h5>
                                            <span class="badge badge-pill badge-success">{{ $item->ActualPrice }} </span>
                                        </h5>
                                    </div>
                                    <h4 class="card-title">{{ $item->BrandName }}</h4>
                                    <h6>{{ $item->ItemDescription }}</h6>
                                    <p class="card-text" style="border-bottom: 1px solid gray; border-top: 1px solid gray;">
                                    {{ $item->SizeName }} <br />Color: {{ $item->ColorName }}</p>
                                    {{-- <a href="#" class="btn btn-fr">Comprar</a> --}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endif
