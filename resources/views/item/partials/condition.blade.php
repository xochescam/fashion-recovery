<div class="form-group col-md-6">
    <div class="d-flex justify-content-between">
      <label for="TypeID">Condición de la prenda *</label>
      <span>
        <p class="btn-tooltip">
          <i class="far fa-question-circle"></i>
          <span class="btn-tooltip__text btn-tooltip__text--wide">
            Para Fashion Recovery la higiene en prendas es muy importante, recuerda realizar tus envios con el mayor cuidado.
          </span>
        </p> 
      </span>
    </div>
    
    <select id="TypeID" class="form-control" name="TypeID" required>
      <option value="" selected>- Seleccionar -</option>

          @foreach($types as $type)

          <option value="{{ $type->TypeID }}"  
            {{ old('TypeID') && (old('TypeID') == $type->TypeID) ? 'selected' :  ($item && ($type->TypeID == $item->TypeID) ? 'selected' : '') }}>
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