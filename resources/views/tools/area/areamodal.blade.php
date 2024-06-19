<div class="modal fade" id="addarea" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Register Area</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

    
            <div class="row mb-3">
                <input type="hidden" name="idval" id="idval" value="0">

                    <label for="addareacode" class="col-md-4 col-form-label text-md-end">{{ __('Area code') }}</label>
                    <div class="col-md-6">
                        <input id="addareacode" type="number" class="form-control" name="addareacode" value="{{ old('areacode') }}" required autocomplete="areacode" autofocus>
            
                        
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="municipality" class="col-md-4 col-form-label text-md-end">{{ __('Municipality') }}</label>
            
                    <div class="col-md-6">
                        <input id="municipality" type="text" class="form-control" name="municipality" value="{{ old('municipality') }}">
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="barangay" class="col-md-4 col-form-label text-md-end">{{ __('Barangay') }}</label>
            
                    <div class="col-md-6">
                        <input id="barangay" type="text" class="form-control " name="barangay" value="{{ old('barangay') }}" required autocomplete="barangay">
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="purok" class="col-md-4 col-form-label text-md-end">{{ __('Purok') }}</label>
            
                    <div class="col-md-6">
                        <input id="purok" type="text" class="form-control " name="purok" value="{{ old('purok') }}" required autocomplete="purok">
            
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
          <button type="submit" id="save" class="btn btn-primary ">Save</button>
        </div>
      </div>
    </div>
  </div>