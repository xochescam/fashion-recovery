<div class="form-group col-md-6">
    <label for="SizeID">Talla *</label>
    <select id="SizeID" class="form-control js-sizes-select" name="SizeID" data-sizes="{{ $sizes }}" required>
      <option value="">- Seleccionar -</option>

      @if($item)
        @foreach((old('CategoryID') ? $sizes[old('CategoryID')] : $sizes[$item->CategoryID]) as $size)
        <option value="{{ $size->SizeID }}"  
            {{ old('SizeID') && (old('SizeID') == $size->SizeID) ? 'selected' :  ($item && ($size->SizeID == $item->SizeID) ? 'selected' : '') }}>
            {{ $size->SizeName }}
          </option>
        @endforeach
      @endif

    </select>
    <small>¿Cuál es la talla de la prenda?</small>

      @if ($errors->has('SizeID'))
        <div class="invalid-feedback">
          {{ $errors->first('SizeID') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo talla es obligatorio.
        </div>
      @endif
  </div>