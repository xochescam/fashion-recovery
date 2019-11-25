<div class="modal fade" id="updateWishlist-{{ $wishlist['WishListID'] }}" tabindex="-1" role="dialog" aria-labelledby="updateCollection" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="updateCollection">Edita tu colección</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('wishlists.update',$wishlist['WishListID']) }}" class="was-validated">
              @csrf

              <div class="form-group">
                <label for="NameList" class="col-form-label">Nombre del wishlist:</label>
                <input type="text" class="form-control" id="NameList" name="NameList" value="{{ isset($wishlist['NameList']) ? $wishlist['NameList'] : '' }}" required>

                <div class="invalid-feedback">
                  El campo nombre del wishlist es obligatorio
                </div>
              </div>

              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="IsPublic" name="IsPublic"  value="1" {{ isset($wishlist['IsPublic']) ? ($wishlist['IsPublic'] == true ? 'checked' : '' ) : 'checked'}}>
                  <label class="form-check-label" for="IsPublic">
                    ¿Es pública?
                  </label>
                </div>
              </div>

              <div class="text-center row">
                <div class="col-md-6 mb-3 mb-md-0">
                  <a href="{{ route('wishlists.destroy',$wishlist['WishListID']) }}" class="btn btn-danger w-100">
                    <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                    Eliminar
                  </a>
                </div>
                
                <div class="col-md-6">
                  <button class="btn btn-fr btn-block" type="submit">
                    <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                      Guardar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
</div>