
<div class="modal modal-lg fade" id="modalsaveupdate" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Register Function Modules</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="row mb-3">
                <input type="hidden" name="idval" id="idval" value="0">
                <label for="idvalue" class="col-md-4 col-form-label text-md-end">{{ __('Menu Module') }}</label>
                <div class="col-md-6">
                    <input id="idvalue" type="text" class="form-control" name="idvalue" value="{{ old('Menu Function') }}" required autocomplete="idvalue" readonly>
                    <input id="mmodules_id" type="hidden" class="form-control" name="mmodules_id" value="{{ old('Menu Function') }}" required autocomplete="mmodules_id" readonly>
                    
                </div>
            </div>
            <table class="table" id="appendfunction">
              <thead>
                  <tr>
                      <th scope="col">Description</th>
                      <th scope="col">Icon</th>
                      <th scope="col">Route</th>
                      <th scope="col">Sort</th>
                      <th scope="col">Type</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody id="appendetails">


                <input type="text" id="transNo">
              </tbody>
              <tbody >
                  <tr class="center-icon-row" style="text-align: center;">
                      <td colspan="4">
                        <button class="btn btn-success btn-sm" id="plus">
                          <i class="bi bi-plus-circle"></i>
                      </button>
                      </td>
                  </tr>
              </tbody>
          </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-saveupdate">Save</button>
        </div>
      </div>
    </div>
</div>

