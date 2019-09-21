<div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="BrandID">Marca *</label>

    <select id="BrandID" class="form-control js-brands-select" name="BrandID" value="{{ $item ? $item->first()->BrandID : '' }}"  data-size="false" required>
        <option value="" {{ !isset($otherBrand->OtherBrand) && !isset($item) ? 'selected' : '' }}>- Seleccionar -</option>

        @if(isset($brands))
          @foreach($brands as $brand)
            <option value="{{ $brand->BrandID }}" {{ $item && $item->first()->BrandID == $brand->BrandID || old('BrandID') ? 'selected' : '' }} >{{ $brand->BrandName }}</option>
          @endforeach
        @endif

        <option value="other" {{ isset($otherBrand->OtherBrand) ? 'selected' : '' }}> Otra marca</option>

    </select>

    <small>¿De qué marca es está prenda?</small>

    @if ($errors->has('BrandID'))
      <div class="invalid-feedback">
        {{ $errors->first('BrandID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo marca es obligatorio.
      </div>
    @endif
  </div>

  