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

</div>

@if($items->count() > 0)

    <div class="row p-0 p-md-3 mb-5 mx-md-5">
        <div class="col-md-2 d-block">
            <search-filter-component
                filters="{{ json_encode($filters) }}"
            ></search-filter-component>
        </div>

        <div class="p-0 col-md-10">
            <div class="container-fluid">
                <div class="row justify-content-start shadow-lg p-3 mb-5 bg-white rounded" id="container-filters">
                    @include('item.partials.card')
                </div>
            </div>
        </div>
    </div>
    
@endif
