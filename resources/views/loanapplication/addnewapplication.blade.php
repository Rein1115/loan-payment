@extends('layouts.appclient')

@section('content')

</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
            <a href="{{route('loan-applications.index')}}">Go back</a>
            <h1>{{ $title }}</h2>
        </div>
		<div class="col-md-12">
			<form method="post" class="needs-validation cform" id="loan_form" novalidate>
				<div class="row">
					<input type="hidden" name="id" id="id" value="{{ $client->id ?? '0' }}"/>
					<div class="col-md-3 mb-2">
						<label class="mb-1">Loan Type</label>
						<select name="loanType" id="loantype" class="form-control text-center" required>
						<option value="{{$loan->loanType}}" disabled selected>Select Loan Type</option>
						<option value="microloan">Micro-loan</option>
						</select>
					</div>
					<div class="col-md-5 mb-4">
						<label class="mb-1">Loan Purpose</label>
						<input type="text" name="loanPurpose" id="loanpurpose" class="form-control text-center" required value="{{ $loan->loanPurpose ?? '' }}" placeholder="Loan Purpose"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-1">Loan Amount</label>
						<input type="number" name="loanAmount" id="loanamount" class="form-control text-center" required value="{{ $loan->loanAmount ?? '' }}" placeholder="Loan Amount"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-1">Period Days</label>
						<input type="number" name="period_days" id="period_days" class="form-control text-center" required value="{{ $loan->period_days ?? '' }}" placeholder="Period Days"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-1">Terms</label>
						<input type="text" name="term" id="term" class="form-control text-center" required value="{{ $loan->term ?? '' }}" placeholder="Term"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-1">Interest</label>
						<input type="number" name="interest_per_month" id="interest" class="form-control text-center" required value="{{ $loan->interest_per_month ?? '' }}" placeholder="Interest"/>
					</div>
					<div class="col-md-2 mb-2">
						<label class="mb-1">Interest Amount</label>
						<input type="number" name="interest_amount" id="interest_amount" class="form-control text-center" required value="{{ $loan->interest_amount ?? '' }}" placeholder="Interest Amount" readonly/>
					</div>
					<div class="col-md-4 mb-3">
						<label for="client" class="mb-1">Client Name</label>
						<select name="clientId" id="client" class="form-control" required>
							<option value="" disabled selected>Select a client</option>
							@foreach ($clients as $client)
							<option value="{{$client->id }}">{{ $client->firstname.' '. $client->lastname }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-md-4 mb-3">
						<label class="mb-1">Total Amount</label>
						<input type="number" name="total_amount" id="total_amount" class="form-control text-center" required value="{{ $loan->total_amount ?? '' }}" placeholder="Total Amount"/>
					</div>
					<div class="col-md-2 mb-2">
						<label class="mb-1">Daily Dues</label>
						<input type="number" name="daily_dues" id="daily_dues" class="form-control text-center" required value="{{ $loan->daily_dues ?? '' }}" placeholder="Daily Dues" readonly/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-1">Co-Maker</label>
						<input type="text" name="co_maker" id="co_maker" class="form-control text-center" required value="{{$loan->co_maker}}" placeholder="Co-Maker"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-1">Checked By</label>
						<input type="text" name="checkedBy" id="checkedBy" class="form-control text-center" required value="{{$loan->checkedBy}}" placeholder="Checked By"/>
					</div>
					<div class="col-md-4 mb-3">
						<label class="mb-1">Approved By</label>
						<input type="text" name="approvedBy" id="approvedBy" class="form-control text-center" required value="{{$loan->approvedBy}}" placeholder="Approved By"/>
					</div>
				</div>
				<div class="d-flex justify-content-end">
					<button class="btn btn-primary" id="Save">Save</button>
				</div>
			</form>
		</div>
	</div>
	
	
</div>
@endsection

@section('script')
@vite('resources/js/loanapplication/loanapplicationdetail.js')
@vite('resources/js/tools/import.js')
@endsection
