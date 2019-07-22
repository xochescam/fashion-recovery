<form method="POST" action="{{ url('filter') }}"  class="needs-validation" novalidate>
    <div class="row mb-3">
        <div class="col-12 col-md-3">

            @csrf

            <input type="hidden" name="search" value="{{ $search }}">

            <h6 class="font-weight-bold mt-3">DEPARTAMENTO</h6>
            @foreach($departments as $key => $department)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $department->first()->DepartmentID }}" id="DepartmentID-{{ $department->first()->DepartmentID }}" name="DepartmentID[]" {{ isset($department->first()->isChecked) ? 'checked' : '' }}>
                    <label class="form-check-label" for="DepartmentID-{{ $department->first()->DepartmentID }}">
                        {{ $key  }}
                    </label>
                    <span class="badge badge-fr"> {{ $department->count() }} </span>
                </div>
            @endforeach

            <h6 class="font-weight-bold mt-3">MARCA</h6>
            @foreach($brands  as $key => $brand)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $brand->first()->BrandID }}" id="BrandID-{{ $brand->first()->BrandID }}" name="BrandID[]" {{ isset($brand->first()->isChecked) ? 'checked' : '' }}>
                    <label class="form-check-label" for="BrandID-{{ $brand->first()->BrandID }}" >
                        {{ $key  }}
                    </label>
                    <span class="badge badge-fr"> {{ $brand->count() }} </span>
                </div>
            @endforeach


            <h6 class="font-weight-bold mt-3">TIPO DE PRENDA</h6>
            @foreach($clothingTypes as $key => $clothingType)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $clothingType->first()->ClothingTypeID }}" id="ClothingTypeID-{{ $clothingType->first()->ClothingTypeID }}" name="ClothingTypeID[]" {{ isset($clothingType->first()->isChecked) ? 'checked' : '' }}>
                    <label class="form-check-label" for="ClothingTypeID-{{ $clothingType->first()->ClothingTypeID }}">
                        {{ $key  }}
                    </label>
                    <span class="badge badge-fr"> {{ $clothingType->count() }} </span>
                </div>
            @endforeach

            <h6 class="font-weight-bold mt-3">COLOR</h6>
            <a href="{{ url()->current() }}"><span class="dot dot-blue"></span></a>
            <a href="#"><span class="dot dot-red"></span></a>
            <a href="#"><span class="dot dot-green"></span></a>
            <a href="#"><span class="dot dot-yellow"></span></a>

            <h6 class="font-weight-bold mt-3">PRECIO</h6>
            <input type="number" name="ActualPrice" class="form-control" value="{{ isset($actualPrice) ? $actualPrice : '' }}" id="ActualPrice">
        </div>
    </div>

    <button type="submit" class="btn btn-fr btn-sm">
        <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
        Filtrar resultados
    </button>
</form>
