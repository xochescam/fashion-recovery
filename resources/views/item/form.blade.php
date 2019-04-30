@csrf

@if(!$item)
  @include('alerts.success')
  @include('alerts.warning')
@endif

@if(!$item)
<div class="form-group">
  <label>Fotos de la prenda *</label>

  <div class="custom-file">
    <input type="file" class="custom-file-input js-add-items" id="PicturesUploaded" name="PicturesUploaded[]" lang="es" multiple value={{ old('PicturesUploaded') }} required>
    <label class="custom-file-label" for="PicturesUploaded">
      {{ isset($seller->PicturesUploaded) ? $seller->PicturesUploaded : (old('PicturesUploaded') ? old('PicturesUploaded') : 'Seleccionar archivos') }}
    </label>
    <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate veniam id molestiae, quasi repudiandae totam.</small>

    <input type="hidden" name="realPicturesUploaded" class="js-input-real-pictures">

    @if ($errors->has('PicturesUploaded'))

      <div class="invalid-feedback">
        {{ $errors->first('PicturesUploaded') }}
      </div>

    @elseif($errors->has('PicturesUploaded.*') && $errors->has('PicturesUploaded.*') > 0)

      @foreach ($errors->get('PicturesUploaded.*') as $error => $value)

        <div class="invalid-feedback">
          {{ $errors->first($error) }}
        </div>

      @endforeach

    @else

      <div class="invalid-feedback">
        El campo fotos de la prenda es obligatorio.
      </div>

    @endif
    
  </div>

  <div class="row js-items-container mt-2" id="">

  </div>
</div>
@endif

<div class="form-group">
  <label for="ItemDescription">Descripción corta *</label>
  <textarea name="ItemDescription" id="ItemDescription" class="form-control" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod..." rows="3" required>{{ $item ? $item->first()->ItemDescription : old('ItemDescription') }}</textarea>
      
  @if ($errors->has('ItemDescription'))
    <div class="invalid-validation">
      {{ $errors->first('ItemDescription') }}
    </div>
  @else
    <div class="invalid-feedback">
      El campo de descripción corta es obligatorio.
    </div>
  @endif    
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="DepartmentID">Departamento *</label>
    <select id="DepartmentID" class="form-control js-departments-select" name="DepartmentID" required>
      <option value="" selected>- Seleccionar -</option>

        @foreach($departments as $department)
          <option value="{{ $department->DepartmentID }}"  {{ ($item && ($department->DepartmentID == $item->first()->DepartmentID) || old('DepartmentID'))  ? 'selected' : '' }} >
              {{ $department->DepName }}
          </option>
        @endforeach
    </select>
    <small>Ejemplo: Niños, Niñas, Hombres...</small>

    @if ($errors->has('DepartmentID'))
        <div class="invalid-feedback">
          {{ $errors->first('DepartmentID') }}
        </div>
    @else
      <div class="invalid-feedback">
        El campo departamento es obligatorio.
      </div>
    @endif
  </div>
  <div class="form-group col-md-6">
    <label for="BrandID">Marca *</label>
    <select id="BrandID" class="form-control js-brands-select" name="BrandID" disabled="true" value="{{ $item ? $item->first()->BrandID : '' }}">

        @if($item)
          <option value="{{ $item->first()->BrandID }}" selected>{{ $brands->where('BrandID',$item->first()->BrandID)->first()->BrandName }}</option>
        @else
          <option value="" selected>- Seleccionar -</option>
        @endif

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
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="SizeID">Talla *</label>
    <select id="SizeID" class="form-control js-sizes-select" name="SizeID" disabled="true" required>
      
      @if($item)
          <option value="{{ $item->first()->SizeID }}" selected>{{ $sizes->where('SizeID',$item->first()->SizeID)->first()->SizeName }}</option>
        @else
          <option value="" selected>- Seleccionar -</option>
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
  <div class="form-group col-md-6">
    <label for="ColorID">Color *</label>
    <select id="ColorID" class="form-control" name="ColorID" required>
      <option value="" selected>- Seleccionar -</option>

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
</div>


<div class="form-row">
  <div class="form-group col-md-6">
    <label for="CategoryID">Categoría *</label>
    <select id="CategoryID" class="form-control" name="CategoryID" required>
      <option value="" selected>- Seleccionar -</option>

          @foreach($categories as $category)
            <option value="{{ $category->CategoryID }}"  {{ ($item && ($category->CategoryID == $item->first()->CategoryID) || old('CategoryID'))  ? 'selected' : '' }} >
              {{ $category->CategoryName }}
            </option>
          @endforeach
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
  <div class="form-group col-md-6">
    <label for="TypeID">Tipo *</label>
    <select id="TypeID" class="form-control" name="TypeID" required>
      <option value="" selected>- Seleccionar -</option>

          @foreach($types as $type)
            <option value="{{ $type->TypeID }}"  {{ ($item && ($type->TypeID == $item->first()->TypeID) || old('TypeID'))  ? 'selected' : '' }} >
              {{ $type->TypeName }}
            </option>
          @endforeach
    </select>
    <small>Ejemplo: Casual, Formal, Playa...</small>

    @if ($errors->has('TypeID'))
      <div class="invalid-feedback">
        {{ $errors->first('TypeID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo tipo es obligatorio.
      </div>
    @endif
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="ClothingTypeID">Condición de mi prenda *</label>
    <select id="ClothingTypeID" class="form-control" name="ClothingTypeID" required>
      <option value="" selected>- Seleccionar -</option>

        @foreach($clothingTypes as $clothingType)
          <option value="{{ $clothingType->ClothingTypeID }}"  {{ ($item && ($clothingType->ClothingTypeID == $item->first()->ClothingTypeID) || old('ClothingTypeID'))  ? 'selected' : '' }} >
            {{ $clothingType->ClothingTypeName }}
          </option>
        @endforeach
    </select>
    <small>?</small>

    @if ($errors->has('ClothingTypeID'))
        <div class="invalid-feedback">
          {{ $errors->first('ClothingTypeID') }}
        </div>
    @else
      <div class="invalid-feedback">
        El campo tipo de ropa es obligatorio.
      </div>
    @endif
  </div> 
  <div class="form-group col-md-6">
    <label for="ClosetID">Colección *</label>
    <select id="ClosetID" class="form-control" name="ClosetID" required>
      <option value="" selected>- Seleccionar -</option>

      @if($closets->count() == 0)
        <option value="default" > Colección por defecto </option>
      @endif

      @foreach($closets as $closet)
        <option value="{{ $closet->ClosetID }}"  {{ ($item && ($closet->ClosetID == $item->first()->ClosetID) || old('ClosetID'))  ? 'selected' : '' }} >
          {{ $closet->ClosetName }}
        </option>
      @endforeach
    </select>
    <small>¿En qué colección se va a guardar está prenda?</small>

    @if ($errors->has('ClosetID'))
      <div class="invalid-feedback">
        {{ $errors->first('ClosetID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo closet es obligatorio.
      </div>
    @endif
  </div> 
</div>

@if(!$item)
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="OriginalPrice">Precio original *</label>
      <input type="money" class="form-control" name="OriginalPrice" id="OriginalPrice" value="" required>
      <small>¿Cuánto te costo la prenda??</small>

      @if ($errors->has('OriginalPrice'))
        <div class="invalid-feedback">
          {{ $errors->first('OriginalPrice') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo precio original es obligatorio.
        </div>
      @endif
    </div>

    <div class="form-group col-md-6">
      <label for="ActualPrice">Precio actual *</label>

      <input type="money" class="form-control" name="ActualPrice" id="ActualPrice" value="" required>
      <small>¿En cuánto venderás la prenda?</small>

      @if ($errors->has('ActualPrice'))
        <div class="invalid-feedback">
          {{ $errors->first('ActualPrice') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo precio actual es obligatorio.
        </div>
      @endif
    </div>
  </div>
@endif
<div class="form-group">
  <div class="form-check mt-2">
    <input class="form-check-input js-check-offer" type="checkbox" id="offer" name="offer"  value="true" {{ $item && $item->first()->OffSaleID !== null ? 'checked' : '' }}>
    <label class="form-check-label" for="offer">¿Te gustaría agregar una oferta a la prenda?
    </label>
  </div>
</div>

<div class="card mb-4 js-check-container {{ $item && $item->first()->OffSaleID !== null ? '' : 'hidden' }}">
  <div class="card-body">
    <div class="form-group">
      <label for="Discount">Descuento *</label>
      <input type="number" class="form-control" name="Discount" id="Discount" value="{{ $item && $item->first()->OffSaleID !== null ? $offers[$item->first()->OffSaleID][0]->Discount : old('Discount') }}">
      <small>Escribe el porcentaje de descuento que le deseas aplicar a la prenda.</small>

      @if ($errors->has('Discount'))
        <div class="invalid-validation">
          {{ $errors->first('Discount') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo descuento es obligatorio.
        </div>
      @endif
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="ValidFrom">Desde *</label>
        <input type="text" class="form-control" name="ValidFrom" id="ValidFrom" value="{{ isset($ValidFrom) && $ValidFrom !== '' ? $ValidFrom : '' }}" onblur="(this.type='text')" onfocus="(this.type='date')" placeholder="dd/mm/yyyy">
        <small>Selecciona la fecha inicial de la oferta.</small>

        @if ($errors->has('ValidFrom'))
          <div class="invalid-validation">
            {{ $errors->first('ValidFrom') }}
          </div>
        @else
          <div class="invalid-feedback">
            El campo desde es obligatorio.
          </div>
        @endif
      </div>

      <div class="form-group col-md-6">
        <label for="ValidUntil">Hasta *</label>
        <input type="text" class="form-control" name="ValidUntil" id="ValidUntil" value="{{ isset($ValidUntil) && $ValidUntil !== '' ? $ValidUntil : '' }}" onblur="(this.type='text')" onfocus="(this.type='date')" placeholder="dd/mm/yyyy">
        <small>Selecciona la fecha final de la oferta.</small>

        @if ($errors->has('ValidUntil'))
          <div class="invalid-validation">
            {{ $errors->first('ValidUntil') }}
          </div>
        @else
          <div class="invalid-feedback">
            El campo hasta es obligatorio.
          </div>
        @endif
      </div>
    </div>
  </div>
</div>


