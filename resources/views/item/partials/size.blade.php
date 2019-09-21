<div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="SizeID">Talla *</label>
    <select id="SizeID" class="form-control js-sizes-select" name="SizeID" data-sizes="{{ $sizes }}" required>
      <option value="" selected>- Seleccionar -</option>
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