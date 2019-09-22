<div class="form-group col-md-6">
    <label for="ColorID">Color *</label>
    <select id="ColorID" class="form-control" name="ColorID" required>
      <option value="" selected >- Seleccionar -</option>

        @foreach($colors as $color)
          <option value="{{ $color->ColorID }}"  
            {{ old('ColorID') && (old('ColorID') == $color->ColorID) ? 'selected' :  ($item && ($color->ColorID == $item->ColorID) ? 'selected' : '') }}>
            {{ $color->ColorName }}
          </option>
        @endforeach
    </select>
    <small>¿De qué color es la prenda?</small>

    @if ($errors->has('ColorID'))
      <div class="invalid-feedback">
        {{ $errors->first('ColorID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo color es obligatorio.
      </div>
    @endif
  </div>