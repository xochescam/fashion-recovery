
    <form method="POST" action="{{ url('filter') }}"  class="needs-validation" novalidate>
        <div class="row mb-3">
            <div class="col-12">

                @csrf

                <input type="hidden"  id="items" value="{{ isset($items) ? json_encode($items) : '' }}">
                <input type="hidden" id="filters" value="{{ isset($filters) ? json_encode($filters) : '' }}">
                <input type="hidden" name="search" value="{{ isset($search->DepName) ? $search->DepName : (isset($search->BrandName) ? $search->BrandName : (isset($search->ClothingStyleName) ? $search->ClothingStyleName : $search) ) }}">
                <input type="hidden" name="filterType" value="{{ $filterType }}">

                <h6 class="font-weight-bold mt-3">DEPARTAMENTO</h6>
                @foreach($filters['departments'] as $key => $department)
                    <div class="form-check">
                        <input class="form-check-input filter-option departments-filters" type="checkbox" value="{{ $key }}" id="DepartmentID-{{ $key }}" name="DepartmentID[]" {{ isset($department->first()->isChecked) ? 'checked' : '' }}>
                        <label class="form-check-label" for="DepartmentID-{{ $key }}">
                            {{ $key  }}
                        </label>
                        <span class="badge badge-fr"> {{ $department->count() }} </span>
                    </div>
                @endforeach

                <h6 class="font-weight-bold mt-4">TIPO DE PRENDA</h6>
                @foreach($filters['clothingTypes'] as $key => $clothingType)
                    <div class="form-check">
                        <input class="form-check-input filter-option clothingTypes-filters" type="checkbox" value="{{ $key }}" id="ClothingTypeID-{{ $key }}" name="ClothingTypeID[]" {{ isset($clothingType->first()->isChecked) ? 'checked' : '' }}>
                        <label class="form-check-label" for="ClothingTypeID-{{ $key }}">
                            {{ $key  }}
                        </label>
                        <span class="badge badge-fr"> {{ $clothingType->count() }} </span>
                    </div>
                @endforeach

                <h6 class="font-weight-bold mt-4">MARCA</h6>
                @foreach($filters['brands']  as $key => $brand)
                    <div class="form-check">
                        <input class="form-check-input filter-option brands-filters" type="checkbox" value="{{ $key }}" id="BrandID-{{ $key }}" name="BrandID[]" {{ isset($brand->first()->isChecked) ? 'checked' : '' }}>
                        <label class="form-check-label" for="BrandID-{{ $key }}" >
                            {{ $key  }}
                        </label>
                        <span class="badge badge-fr"> {{ $brand->count() }} </span>
                    </div>
                @endforeach

                <h6 class="font-weight-bold mt-4">COLOR</h6>
                @foreach($filters['colors']  as $key => $color)
                    <div class="form-check">
                        <input class="form-check-input filter-option colors-filters" type="checkbox" value="{{ $key }}" id="ColorID-{{ $key }}" name="BrandID[]" {{ isset($brand->first()->isChecked) ? 'checked' : '' }}>
                        <label class="form-check-label" for="ColorID-{{ $key }}" >
                            {{ $key  }}
                        </label>
                        <span class="badge badge-fr"> {{ $brand->count() }} </span>
                    </div>
                @endforeach
            </div>
        </div>
    </form>