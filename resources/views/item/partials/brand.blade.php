<div class="form-group col-md-6">
    <label for="BrandID">Marca *</label>

    <select id="BrandID" class="form-control js-brands-select" name="BrandID" value="{{ $item ? $item->BrandID : '' }}"  data-size="false" required>
        <option value="">- Seleccionar -</option>

        @foreach($brands as $brand)

          <option value="{{ $brand->BrandID }}"  
            {{ old('BrandID') && (old('BrandID') == $brand->BrandID) ? 'selected' :  ($item && !$item->OtherBrand && ($brand->BrandID == $item->BrandID) ? 'selected' : '') }}>
            {{ $brand->BrandName }}
          </option>
          
        @endforeach

        <option value="other" {{ $item && $item->OtherBrand ? 'selected' : '' }}> Otra marca</option>

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

  