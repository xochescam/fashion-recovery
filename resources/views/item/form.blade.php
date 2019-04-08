  @csrf

  @include('alerts.success')
  @include('alerts.warning')


  <div class="form-group">
    <label>Fotos de la prenda</label>

    <div class="custom-file">
      <input type="file" class="custom-file-input is-invalid" id="PicturesUploaded" name="PicturesUploaded[]" lang="es" multiple value={{ old('PicturesUploaded') ? old('PicturesUploaded') : '' }} >
      <label class="custom-file-label" for="PicturesUploaded">
        {{ isset($seller->PicturesUploaded) ? $seller->PicturesUploaded : (old('PicturesUploaded') ? old('PicturesUploaded') : 'Seleccionar archivos') }}
      </label>


      @if ($errors->has('PicturesUploaded'))

        <div class="invalid-feedback">
            {{ $errors->first('PicturesUploaded') }}
        </div>

      @elseif(count($errors->has('PicturesUploaded.*')) > 0)

        @foreach ($errors->get('PicturesUploaded.*') as $error => $value)

          <div class="invalid-feedback">
            {{ $errors->first($error) }}
          </div>

        @endforeach

      @endif

    </div>
  </div>

  <div class="form-group">
    <label for="OriginalPrice">Precio original</label>
    <input type="number" class="form-control is-invalid" name="OriginalPrice" id="OriginalPrice" value=" {{ isset($item->OriginalPrice) ? $item->OriginalPrice : old('OriginalPrice') }}">

    @if ($errors->has('OriginalPrice'))
      <div class="invalid-feedback">
        {{ $errors->first('OriginalPrice') }}
      </div>
    @endif
  </div>

  <div class="form-group">
    <label for="ActualPrice">Precio actual</label>
    <input type="number" class="form-control is-invalid" name="ActualPrice" id="ActualPrice" value=" {{ isset($item->ActualPrice) ? $item->ActualPrice : old('ActualPrice') }}">

    @if ($errors->has('ActualPrice'))
      <div class="invalid-feedback">
        {{ $errors->first('ActualPrice') }}
      </div>
    @endif
  </div>

	<div class="form-group">
    <label for="ColorID">Color</label>
    <select id="ColorID" class="form-control is-invalid" name="ColorID">
      <option value="" selected>- Seleccionar -</option>

          @foreach($colors as $color)
            <option value="{{ $color->ColorID }}"  {{ (isset($item->ColorID) && ($color->ColorID == $item->ColorID) || old('ColorID'))  ? 'selected' : '' }} > {{ $color->ColorName }} </option>
          @endforeach
    </select>

    @if ($errors->has('ColorID'))
        <div class="invalid-feedback">
          {{ $errors->first('ColorID') }}
        </div>
    @endif
  </div>

  <div class="form-group">
    <label for="SizeID">Tamaño</label>
    <select id="SizeID" class="form-control is-invalid" name="SizeID">
      <option value="" selected>- Seleccionar -</option>

          @foreach($sizes as $size)
            <option value="{{ $size->SizeID }}"  {{ (isset($item->SizeID) && ($size->SizeID == $item->SizeID) || old('SizeID'))  ? 'selected' : '' }} > {{ $size->SizeName }} </option>
          @endforeach
    </select>

    @if ($errors->has('SizeID'))
        <div class="invalid-feedback">
          {{ $errors->first('SizeID') }}
        </div>
    @endif
  </div>

  <div class="form-group">
    <label for="ClothingTypeID">Tipo de ropa</label>
    <select id="ClothingTypeID" class="form-control is-invalid" name="ClothingTypeID">
      <option value="" selected>- Seleccionar -</option>

          @foreach($clothingTypes as $clothingType)
            <option value="{{ $clothingType->ClothingTypeID }}"  {{ (isset($item->ClothingTypeID) && ($clothingType->ClothingTypeID == $item->ClothingTypeID) || old('ClothingTypeID'))  ? 'selected' : '' }} >
              {{ $clothingType->ClothingTypeName }}
            </option>
          @endforeach
    </select>

    @if ($errors->has('ClothingTypeID'))
        <div class="invalid-feedback">
          {{ $errors->first('ClothingTypeID') }}
        </div>
    @endif
  </div>

  <div class="form-group">
    <label for="DepartmentID">Departamento</label>
    <select id="DepartmentID" class="form-control is-invalid" name="DepartmentID">
      <option value="" selected>- Seleccionar -</option>

          @foreach($departments as $department)
            <option value="{{ $department->DepartmentID }}"  {{ (isset($item->DepartmentID) && ($department->DepartmentID == $item->DepartmentID) || old('DepartmentID'))  ? 'selected' : '' }} >
              {{ $department->DepName }}
            </option>
          @endforeach
    </select>

    @if ($errors->has('DepartmentID'))
        <div class="invalid-feedback">
          {{ $errors->first('DepartmentID') }}
        </div>
    @endif
  </div>

  <div class="form-group">
    <label for="CategoryID">Categoria</label>
    <select id="CategoryID" class="form-control is-invalid" name="CategoryID">
      <option value="" selected>- Seleccionar -</option>

          @foreach($categories as $category)
            <option value="{{ $category->CategoryID }}"  {{ (isset($item->CategoryID) && ($category->CategoryID == $item->CategoryID) || old('CategoryID'))  ? 'selected' : '' }} >
              {{ $category->CategoryName }}
            </option>
          @endforeach
    </select>

    @if ($errors->has('CategoryID'))
        <div class="invalid-feedback">
          {{ $errors->first('CategoryID') }}
        </div>
    @endif
  </div>

  <div class="form-group">
    <label for="TypeID">Tipo</label>
    <select id="TypeID" class="form-control is-invalid" name="TypeID">
      <option value="" selected>- Seleccionar -</option>

          @foreach($types as $type)
            <option value="{{ $type->TypeID }}"  {{ (isset($item->TypeID) && ($type->TypeID == $item->TypeID) || old('TypeID'))  ? 'selected' : '' }} >
              {{ $type->TypeName }}
            </option>
          @endforeach
    </select>

    @if ($errors->has('TypeID'))
        <div class="invalid-feedback">
          {{ $errors->first('TypeID') }}
        </div>
    @endif
  </div>

  <div class="form-group">
    <label for="ClosetID">Closet</label>
    <select id="ClosetID" class="form-control is-invalid" name="ClosetID">
      <option value="" selected>- Seleccionar -</option>

          @if($closets->count() == 0)
              <option value="default" > Closet por defecto </option>
          @endif

          @foreach($closets as $closet)
            <option value="{{ $closet->ClosetID }}"  {{ (isset($item->ClosetID) && ($closet->ClosetID == $item->ClosetID) || old('ClosetID'))  ? 'selected' : '' }} >
              {{ $closet->ClosetName }}
            </option>
          @endforeach
    </select>

    @if ($errors->has('ClosetID'))
        <div class="invalid-feedback">
          {{ $errors->first('ClosetID') }}
        </div>
    @endif
  </div>

  <div class="form-group">
    <label for="OffSaleID">Oferta</label>
    <select id="OffSaleID" class="form-control is-invalid" name="OffSaleID">
      <option value="" selected>- Seleccionar -</option>

          @foreach($offers as $offer)
            <option value="{{ $offer->OfferID }}"  {{ (isset($item->OfferID) && ($offer->OfferID == $item->OfferID) || old('OffSaleID'))  ? 'selected' : '' }} >
              {{ $offer->Discount }}
            </option>
          @endforeach
    </select>

    @if ($errors->has('OffSaleID'))
        <div class="invalid-feedback">
          {{ $errors->first('OffSaleID') }}
        </div>
    @endif
  </div>

  <button type="submit" class="btn btn-fr btn-block">Subir</button>