
<div class="modal modal-lg fade" id="modalsaveupdate" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Register Area</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <input type="hidden" name="idval" id="idval" value="0">
                <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                <div class="col-md-6">
                    <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname') }}" required autocomplete="fname">
                </div>
            </div>
            <div class="row mb-3">
                <label for="mname" class="col-md-4 col-form-label text-md-end">{{ __('Middle Name') }}</label>
                <div class="col-md-6">
                    <input id="mname" type="text" class="form-control" name="mname" value="{{ old('mname') }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="lname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                <div class="col-md-6">
                    <input id="lname" type="text" class="form-control " name="lname" value="{{ old('lname') }}" required autocomplete="lname">
                </div>
            </div>
            <div class="row mb-5">
                <label for="areaid" class="col-md-4 col-form-label text-md-end">{{ __('Area') }}</label>
                <div class="col-md-6">
                    <!-- Select2 dropdown -->
                    <select id="areaid" class="form-control select2" name="areaid" required>
                    </select>
                </div>
            </div>  
            {{--start datatable --}}
            <div class="row mb-3">
                <table id="areatable" class="table table-bordered table-striped border" style="width:80%; margin: 0 auto;">
                    <thead>
                        <tr>
                            <th><b>Municipality/City</b></th>
                            <th><b>Barangay</b></th>
                            <th><b>Purok</b></th>
                        </tr>
                    </thead>
                    <tbody> 
                    </tbody>
                </table>
            </div>
            {{--end datatable --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-saveupdate">Save</button>
        </div>
      </div>
    </div>
</div>

