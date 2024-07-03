@extends('layouts.appclient')

@section('content')

</div>
<div class="container-md pb-4">
	<div class="row">
		<div class="col-md-12">
            <a href="{{route('loan-applications.index')}}">Go back</a>
        </div>
        <div class="row">
                <div class="col-2">test</div>
            </div>
		
        <h1 class="text-center"> {{$title}}</h1>
        <hr>
        <div class="row">
            
                @foreach($data as $item)
            <div class="row">
                <div class="col-6">
                    <p class="text-capitalize"><b>Date Applied:</b> {{$item->created_at}}</p>
                </div>
                <div class="col-6">
                    <p class="text-capitalize"><b>Loan purpose:</b> {{$item->loanPurpose}}</p>
                </div>
            </div>
            <div class="row">
                <p>I hereby apply a loan of <span class="text-decoration-underline">{{$item->loanAmount}} </span> for a period of <span class="text-decoration-underline">{{$item->period_days}} </span> days payable in <span class="text-decoration-underline"> {{$item->term}} </span>(term) at <span class="text-decoration-underline">{{$item->interest_per_month * 100}}</span>% per month.</p>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="text-capitalize"><b>Client Name:</b> {{$item->firstname}} {{$item->lastname}}</p>
                </div>
                <div class="col-6">
                    <p class="text-capitalize"><b>Date of Birth:</b> {{$item->dob}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="text-capitalize"><b>Educational Attainment:</b> {{$item->edu_att}}</p>
                </div>
                <div class="col-6">
                    <p class="text-capitalize"><b>Gender:</b> {{$item->gender}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="text-capitalize"><b>Present Address:</b> {{$item->present_add}}</p>
                </div>
                <div class="col-6">
                    <p class="text-capitalize"><b>Marital Status:</b> {{$item->civil_status}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="text-capitalize"><b>Provincial Address:</b> {{$item->prov_add}}</p>
                </div>
                <div class="col">
                    <p class="text-capitalize"><b>Religion:</b> {{$item->religion}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="text-capitalize"><b>Occupation:</b> {{$item->occupation}}</p>
                </div>
                <div class="col-6">
                    <p class="text-capitalize"><b>Salary/Income:</b> {{$item->salary_income}}</p>
                </div>
            </div>
            <div class="row">
                <p class="text-capitalize"><b>Name of Business:</b> {{$item->nameOfBusiness}}</p>
                <p class="text-capitalize"><b>Business Address:</b> {{$item->addOfBusiness}}</p>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="text-capitalize"><b>Monthly Income:</b> {{$item->mo_income}}</p>
                </div>
                <div class="col">
                    <p class="text-capitalize"><b>Contact #:</b> {{$item->contact_no}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="text-capitalize"><b>Other Loan:</b> {{$item->otherLoan}}</p>
                </div>
            </div>
            <div class="col-3">
                <p class="text-capitalize"><b>Loan Type:</b> {{$item->loanType}}</p>
            </div>
            <br><br>
            <h5><b>PERSONAL DATA OF SPOUSE</b></h5>
            <br><br>
            <div class="row">
                <p class="text-capitalize"><b>Spouse Name:</b> {{$item->sp_name}}</p>
                <p class="text-capitalize"><b>Address:</b> {{$item->sp_add}}</p>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="text-capitalize"><b>Occupation:</b> {{$item->sp_occupation}}</p>
                </div>
                <div class="col-6">
                    <p class="text-capitalize"><b>Salary/Income:</b> {{$item->sp_salary}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="text-capitalize"><b>No. of Dependents:</b> {{$item->no_dependents}}</p>
                </div>
                <div class="col-6">
                    <p class="text-capitalize"><b>Contact #:</b> {{$item->sp_contact}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="text-capitalize"><b>Name of Children:</b> {{$item->sp_children}}</p>
                </div>
            </div>
            <div class="row border">
                <div class="col-6">
                <img src="{{ $item->client_pic_base64 ?? ''}}" alt="Client Picture" >
                </div>
                <div class="col-6">
                <img src="{{ $item->client_add_sketch_base64 ?? '' }}" alt="Client Picture" >

                </div>
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
