
<div class="form-group col-md-6">
    <label for="ClosetID">Colección</label>
    <create-collection
      :closets="{{ json_encode($closets) }}"
      :item="{{ isset($item->ItemID) ? json_encode($item) : '[]' }}"
      old="{{ old('ClosetID') !== null ? old('ClosetID') : '' }}"
    >
    </create-collection>
      
    <small>¿En qué colección se va a guardar está prenda?</small>

    @if ($errors->has('ClosetID'))
      <div class="invalid-feedback">
        {{ $errors->first('ClosetID') }}
      </div>
    @endif
</div>