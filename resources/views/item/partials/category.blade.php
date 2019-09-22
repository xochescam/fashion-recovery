<div class="form-group col-md-6">
    <label for="CategoryID">Categoría *</label>
    <select id="CategoryID" class="form-control js-categories-select" name="CategoryID" data-categories="{{ $categories }}" required>
      <option value="" selected>- Seleccionar -</option>

      @if($item)
        @foreach($categories[$item->DepartmentID] as $category)

          <option value="{{ $category->CategoryID }}"  
            {{ old('CategoryID') && (old('CategoryID') == $category->CategoryID) ? 'selected' :  ($item && ($category->CategoryID == $item->CategoryID) ? 'selected' : '') }}>
            {{ $category->CategoryName }}
          </option>
          
        @endforeach
      @endif

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