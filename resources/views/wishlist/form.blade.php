@csrf

	@if(isset($id))
		<input type="hidden" name="ItemID" value="{{ $id }}" required>
	@endif

	<div class="form-group">
	<label for="NameList" class="col-form-label">Nombre del wishlist:</label>
	<input type="text" class="form-control" id="NameList" name="NameList" value="{{ isset($Wishlist->NameList) ? $Wishlist->NameList : '' }}" required>

	<div class="invalid-feedback">
        El campo nombre del wishlist es obligatorio
    </div>
	</div>


	<div class="form-group">
	<div class="form-check">
    <input class="form-check-input" type="checkbox" id="IsPublic" name="IsPublic"  value="1" {{ isset($Wishlist->IsPublic) ? ($Wishlist->IsPublic == true ? 'checked' : '' ) : ''}}>
    <label class="form-check-label" for="IsPublic">
    	Mantenerla secreta
    </label>
		</div>
</div>

<button type="submit" class="btn btn-fr w-100">
	<span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
	Guardar
</button>