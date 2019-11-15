<div class="row p-3 mx-md-5">
    <p class="w-100">
        <span class="font-weight-bold">{{ $items->count() }}</span> de resultados para <span class="font-weight-bold">
        "{{ app('request')->input('q') !== null ? 
                app('request')->input('q') : 
                (isset($search->DepName) ? 
                    $search->DepName : 
                        (isset($search->BrandName) ? 
                        $search->BrandName : 
                            (isset($search->ClothingStyleName) ? 
                            $search->ClothingStyleName : $search )))  }}"
        </span>
    </p>
     <p class="text-right w-100 d-block d-md-none">
      <a class="btn btn-fr" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Filtrar resultados
      </a>
    </p>
</div>

@if($items->count() > 0)

    <div class="row p-0 p-md-3 mb-5 mx-md-5">
        <div class="collapse d-md-none w-100 p-3" id="collapseExample">
            <div class="card card-body mb-5">
            @include('search.filter')
            </div>
        </div>

        <div class="col-md-2 d-none d-md-block p-0">
            @include('search.filter')
        </div>

        <div class="p-0 col-md-10">
<!--             <section id="resultadosBusqueda">
 -->            <div class="container-fluid">
                    <div class="row justify-content-start shadow-lg p-3 mb-5 bg-white rounded" id="container-filters">
                        @include('item.partials.card')
                    </div>
                </div>
<!--             </section>
 -->    </div>
    </div>
    
@endif
