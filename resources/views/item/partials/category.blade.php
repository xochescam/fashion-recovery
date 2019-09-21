<div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="CategoryID">Categoría *</label>
    <select id="CategoryID" class="form-control js-categories-select" name="CategoryID" data-categories="{{ $categories }}" required>
      <option value="" selected>- Seleccionar -</option>
    </select>
    <small>Ejemplo: Ropa, Calzado, Accesorios...</small>

    @if ($errors->has('CategoryID'))
      <div class="invalid-feedback">
        {{ $errors->first('CategoryID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo categoría es obligatorio.
      </div>
    @endif
  </div>