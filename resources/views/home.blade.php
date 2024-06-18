@extends('layouts.apps')

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Dashboard</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Datatables</h5>
                    <p>
                        Add lightweight datatables to your project using the 
                        <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> 
                        library. Just add <code>.datatable</code> class name to any table you wish to convert to a datatable. 
                        Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.
                    </p>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th><b>Name</b></th>
                                <th>Ext.</th>
                                <th>City</th>
                                <th data-type="date" data-format="YYYY/MM/DD">Start Date</th>
                                <th>Completion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Unity Pugh</td>
                                <td>9958</td>
                                <td>Curicó</td>
                                <td>2005/02/11</td>
                                <td>37%</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>1234</td>
                                <td>New York</td>
                                <td>2010/03/15</td>
                                <td>50%</td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>5678</td>
                                <td>Los Angeles</td>
                                <td>2012/07/23</td>
                                <td>75%</td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
@vite('resources/js/home/home.js')
@endsection
