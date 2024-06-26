@extends('layouts.appclient')

@section('content')

</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
            <a href="{{route('client.index')}}">Go back</a>
            <h1>{{ $title }}</h2>
        </div>
		<div class="col-md-12">
			<form method="post" class="needs-validation" id="client_form" action="{{ route('client.save') }}/{{ $client->id ?? '' }}" novalidate>
				<div class="row">
					<input type="hidden" name="id" id="id" value="{{ $client->id ?? '' }}"/>
					<div class="col-md-4 mb-3">
						<label class="mb-2">Firstname</label>
						<input type="text" name="firstname" id="firstname" class="form-control " required value="{{ $client->firstname ?? '' }}" placeholder="Enter first name"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">Middlename</label>
						<input type="text" name="middlename" id="middlename" class="form-control " required value="{{ $client->middlename ?? '' }}" placeholder="Enter middle name"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">Lastname</label>
						<input type="text" name="lastname" id="lastname" class="form-control " required value="{{ $client->lastname ?? '' }}" placeholder="Enter last name"/>
					</div>
					<div class="col-md-3 mb-3">
						<label class="mb-2">Dob</label>
						<input type="date" name="dob" id="dob" class="form-control " required value="{{ $client->dob ?? '' }}" placeholder="Enter date of birth"/>
					</div>
					<div class="col-md-2 mb-3">
						<label class="mb-2">Gender</label>
						<select name="gender" id="gender" class="form-control " required>
                            <option value="male">Male</option>
                            <option value="male">Male</option>
						</select>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">Edu att</label>
						<input type="text" name="edu_att" id="edu_att" class="form-control " required value="{{ $client->edu_att ?? '' }}" placeholder="Enter highest educational attainment"/>
					</div>
					<div class="col-md-3 mb-3">
						<label class="mb-2">Religion</label>
						<input type="text" name="religion" id="religion" class="form-control " required value="{{ $client->religion ?? '' }}" placeholder="Enter religion"/>
					</div>
					<div class="col-md-12 mb-3">
						<label class="mb-2">Present add</label>
						<input type="text" name="present_add" id="present_add" class="form-control " required value="{{ $client->present_add ?? '' }}" placeholder="Enter present address"/>
					</div>
					<div class="col-md-12 mb-3">
						<label class="mb-2">Prov add</label>
						<input type="text" name="prov_add" id="prov_add" class="form-control " required value="{{ $client->prov_add ?? '' }}" placeholder="Enter provincial address"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">Salary income</label>
						<input type="number" name="salary_income" id="salary_income" class="form-control " required value="{{ $client->salary_income ?? '' }}" placeholder="Enter salary or income"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">Occupation</label>
						<input type="text" name="occupation" id="occupation" class="form-control " required value="{{ $client->occupation ?? '' }}" placeholder="Enter occupation"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">NameOfBusiness</label>
						<input type="text" name="nameOfBusiness" id="nameOfBusiness" class="form-control " required value="{{ $client->nameOfBusiness ?? '' }}" placeholder="Enter Name of Business"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">AddOfBusiness</label>
						<input type="text" name="addOfBusiness" id="addOfBusiness" class="form-control " required value="{{ $client->addOfBusiness ?? '' }}" placeholder="Enter Address of Business"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">Mo income</label>
						<input type="number" name="mo_income" id="mo_income" class="form-control " required value="{{ $client->mo_income ?? '' }}" placeholder="Enter Business monthly income"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">Contact no</label>
						<input type="number" name="contact_no" id="contact_no" class="form-control " required value="{{ $client->contact_no ?? '' }}" placeholder="Enter contact no"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">OtherLoan</label>
						<input type="text" name="otherLoan" id="otherLoan" class="form-control " required value="{{ $client->otherLoan ?? '' }}" placeholder="Other loan"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">Sp name</label>
						<input type="text" name="sp_name" id="sp_name" class="form-control " required value="{{ $client->sp_name ?? '' }}" placeholder="Enter sp name"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">Sp add</label>
						<input type="text" name="sp_add" id="sp_add" class="form-control " required value="{{ $client->sp_add ?? '' }}" placeholder="Enter sp add"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-2">Sp occupation</label>
						<input type="text" name="sp_occupation" id="sp_occupation" class="form-control " required value="{{ $client->sp_occupation ?? '' }}" placeholder="Enter sp occupation"/>
					</div>
					<div class="col-md-2 mb-3">
						<label class="mb-2">Sp salary</label>
						<input type="text" name="sp_salary" id="sp_salary" class="form-control " required value="{{ $client->sp_salary ?? '' }}" placeholder="Enter sp salary"/>
					</div>
					<div class="col-md-3 mb-3">
						<label class="mb-2">No dependents</label>
						<input type="text" name="no_dependents" id="no_dependents" class="form-control " required value="{{ $client->no_dependents ?? '' }}" placeholder="Enter no dependents"/>
					</div>
					<div class="col-md-3 mb-3">
						<label class="mb-2">Sp contact</label>
						<input type="text" name="sp_contact" id="sp_contact" class="form-control " required value="{{ $client->sp_contact ?? '' }}" placeholder="Enter sp contact"/>
					</div>
					<div class="col-md-12 mb-3">
						<label class="mb-2">Sp children</label>
						<textarea type="textarea" name="sp_children" id="sp_children" class="form-control " required placeholder="Enter sp children">{{ $client->sp_children ?? '' }}</textarea>
					</div>
					<div class="col-md-6 mb-3">
						<label class="mb-2">Client pic</label>
						<input type="file" name="client_pic" id="client_pic" class="form-control " required value="{{ $client->client_pic ?? '' }}" placeholder="Enter client pic"/>
					</div>
					<div class="col-md-6 mb-3">
						<label class="mb-2">Client add sketch</label>
						<input type="file" name="client_add_sketch" id="client_add_sketch" class="form-control " required value="{{ $client->client_add_sketch ?? '' }}" placeholder="Enter client add_sketch"/>
					</div>
					<div class="col-md-12 text-end">
						<button type="submit" class="btn btn-success" id="client_form_btn" >Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
    document.getElementById('client_form_btn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission
            const form = document.getElementById('client_form');
            const formData = new FormData(form);
            const url = form.action;
            axios.post(url, formData)
                .then(response => {
                    console.log('Form submitted successfully:', response);
                    // Handle success - you can redirect or show a success message here
                })
                .catch(error => {
                    console.error('Error submitting form:', error);
                    // Handle error - show error message to the user
                });
        });
    </script>
</script>
@vite('resources/js/tools/import.js')
@endsection
