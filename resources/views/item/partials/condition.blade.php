<div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="TypeID">Condición de la prenda *</label>
    <select id="TypeID" class="form-control" name="TypeID" required>
      <option value="" selected>- Seleccionar -</option>

          @foreach($types as $type)
            <option value="{{ $type->TypeID }}"  {{ ($item && ($type->TypeID == $item->first()->TypeID) || old('TypeID'))  ? 'selected' : '' }} >
              {{ $type->TypeName }}
            </option>
          @endforeach
    </select>
    <small>Ejemplo: Nuevo con etiqueta...</small>

    @if ($errors->has('TypeID'))
      <div class="invalid-feedback">
        {{ $errors->first('TypeID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo condición de la prenda es obligatorio.
      </div>
    @endif
  </div>