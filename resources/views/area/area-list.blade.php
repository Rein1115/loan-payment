@extends('layouts.apps')

@section('content')
<div class="pagetitle">
    <h1>Area(s)</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Area</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<div class="container">
   
</div>

<section class="section add-user-section">
    <button type="button" class="btn btn-primary mb-2" id="btnShowNewModal">Add Area</button>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th><b>AreaCode</b></th>
                                <th>Municipality</th>
                                <th>Barangay</th>
                                <th >Purok</th>
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
@include('tools.area.areamodal')
@endsection

@section('script')
@vite('resources/js/tools/import.js')
@vite('resources/js/area/area-list.js')
@endsection
