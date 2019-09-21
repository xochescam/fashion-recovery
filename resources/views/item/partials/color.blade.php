<div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="ColorID">Color *</label>
    <select id="ColorID" class="form-control" name="ColorID" required>
      <option value="" selected >- Seleccionar -</option>

        @foreach($colors as $color)
          <option value="{{ $color->ColorID }}"  {{ ($item && ($color->ColorID === $item->first()->ColorID) || old('ColorID'))  ? 'selected' : '' }} > {{ $color->ColorName }} </option>
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