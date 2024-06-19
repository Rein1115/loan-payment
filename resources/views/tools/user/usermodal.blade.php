<div class="modal fade" id="adduser" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Register New User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

    
                <div class="row mb-3">
                <input type="hidden" name="idval" id="idval" value="0">

                    <label for="firstname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
            
                    <div class="col-md-6">
                        <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
            
                        
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="middlename" class="col-md-4 col-form-label text-md-end">{{ __('Middle Name') }}</label>
            
                    <div class="col-md-6">
                        <input id="middlename" type="text" class="form-control" name="middlename" value="{{ old('middlename') }}">
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
            
                    <div class="col-md-6">
                        <input id="lastname" type="text" class="form-control " name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname">
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
            
                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control " name="username" value="{{ old('username') }}" required autocomplete="username">
            
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
            
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control " name="password" required autocomplete="new-password">
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
            
                    <div class="col-md-6">
                        <input id="confirmpassword" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="account_type" class="col-md-4 col-form-label text-md-end">{{ __('Account Type') }}</label>
            
                    <div class="col-md-6">
                        <select id="account_type" class="form-control" name="account_type" required>
                            <option value="" disabled selected>Select account type</option>
                            <option value="cashier">Cashier</option>
                            <option value="teller">Teller</option>
                        </select>
                    </div>
                </div>     
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
          <button type="submit" id="save" class="btn btn-primary disabled btnOption">Register</button>
        </div>
      </div>
    </div>
  </div>