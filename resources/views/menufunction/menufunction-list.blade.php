@extends('layouts.apps')

@section('content')
<div class="pagetitle">
    <h1>Menu Function(s)</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Menu Function</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section add-user-section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                   

                    <!-- Table with stripped rows -->
                    <table id="mytable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th><b>Description</b></th>
                                <th >Icon</th>
                                <th>Route</th>
                                <th>Sort</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</section>
@include('tools.menufunction.menufunction')
@endsection

@section('script')
@vite('resources/js/tools/import.js')
@vite('resources/js/menufunction/menufunction-list.js')
@endsection
