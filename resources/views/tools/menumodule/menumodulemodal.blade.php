
<div class="modal modal-lg fade" id="modalsaveupdate" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Register Menu Modules</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <input type="hidden" name="idval" id="idval" value="0">
                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                <div class="col-md-6">
                    <input id="description" type="text" class="form-control" name="description" value="{{ old('Description') }}" required autocomplete="description">
                </div>
            </div>
            <div class="row mb-3">
                <label for="icon" class="col-md-4 col-form-label text-md-end">{{ __('Icon') }}</label>
                <div class="col-md-6">
                    <input id="icon" type="text" class="form-control" name="icon" value="{{ old('icon') }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="route" class="col-md-4 col-form-label text-md-end">{{ __('Route') }}</label>
                <div class="col-md-6">
                    <input id="route" type="text" class="form-control " name="route" value="{{ old('route') }}" required autocomplete="route">
                </div>
            </div>

            <div class="row mb-3">
                <label for="sort" class="col-md-4 col-form-label text-md-end">{{ __('Sort') }}</label>
                <div class="col-md-6">
                    <input id="sort" type="text" class="form-control " name="sort" value="{{ old('sort') }}" required autocomplete="sort">
                </div>
            </div>

            <div class="row mb-5">
                <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>
                <div class="col-md-6">
                    <!-- Select2 dropdown -->
                    <select id="type" class="form-control select2" name="type" required>
                    </select>
                </div>
            </div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-saveupdate">Save</button>
        </div>
      </div>
    </div>
</div>

