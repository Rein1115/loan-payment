@extends('layouts.apps')

@section('content')
<div class="container-fluid pt-3">
	<div class="row mb-3">
		<div class="col-md-6 text-capitalize"><h1>Client Management</h2></div>
		<div class="col-md-6 text-end"><a href="{{ route('clients.create') }}" class="btn btn-primary">Add Client</a></div>
		<div class="col-md-12">
			<table class="table table-bordered table-striped" id="tbl_client" style="width: 100%;"></table>
		</div>
	</div>
</div>
@endsection
@section('script')
@vite('resources/js/client/clientdetails.js')
@endsection