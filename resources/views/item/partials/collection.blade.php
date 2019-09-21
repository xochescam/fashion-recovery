
<div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="ClosetID">Colección</label>
    <select id="ClosetID" class="form-control" name="ClosetID" >
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
    @endif
</div>