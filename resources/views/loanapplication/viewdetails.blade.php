@extends('layouts.appclient')

@section('content')

</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
            <a href="{{route('loan-applications.index')}}">Go back</a>
        </div>
		
        <h1 class="text-center"> {{$title}}</h1>
        <hr>
        <div class="row">
            @foreach($data as $data)
            <div class="col-3">
                <p class="text-capitalize"><b>Client Name:</b> {{$data->firstname}} {{$data->lastname}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>Loan Type:</b> {{$data->loanType}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>Loan purpose:</b> {{$data->loanPurpose}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>Applied date:</b> {{$data->created_at}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>Loan amount:</b> {{$data->loanAmount}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>period days:</b> {{$data->period_days}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>term:</b> {{$data->term}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>interest per-month:</b> {{$data->interest_per_month}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>interest amount:</b> {{$data->interest_amount}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>total amount:</b> {{$data->total_amount}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>daily dues:</b> {{$data->daily_dues}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>co-maker:</b> {{$data->co_maker}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>checked by:</b> {{$data->checkedBy}}</p>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>approved by:</b> {{$data->approvedBy}}</p>
            </div>
            
            @endforeach
        </div>
	</div>
	
	
</div>
@endsection

@section('script')
@vite('resources/js/loanapplication/loanapplicationdetail.js')
@vite('resources/js/tools/import.js')
@endsection
