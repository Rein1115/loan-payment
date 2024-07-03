<?php

namespace App\Http\Controllers\LoanApplication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Validator;
use DB;

class LoanApplicationController extends Controller
{
  //resource functions


    //index function
    public function index()
    {
        // resource functions
        $data = $this->menus();
        return view('loanapplication.index', compact('data'));
    }
    //create function
    public function create()
    {
      $title = "Create New Loan Application";
      $clients = DB::SELECT("SELECT * FROM clients ORDER BY id DESC"); 
      return view('loanapplication.addnewapplication', compact('title','clients'));
    }
    //store function
    public function store(Request $request)
    {
      $validator = Validator::make($request -> all(), [
        'loanType' => 'required',
        'loanPurpose' => 'required',
        'loanAmount' => 'required',
        'period_days' => 'required',
        'term' => 'required',
        'interest_per_month' => 'required',
        'interest_amount' => 'required',
        'clientId' => 'required',
        'total_amount' => 'required',
        'daily_dues' => 'required',
        'co_maker' => 'required',
        'checkedBy' => 'required',
        'approvedBy' => 'required'
      ]);

      if($validator->fails()) {
        return response()->json(['status' => false, 'error' => $validator-> errors()]);
      }

      $validatedData = $validator -> validated();

      foreach ($validatedData as $key => $value) {
        if (is_array($value)) {
          $validatedData[$key] = implode(',', $value); // Convert array to string
        }
      }

      $loanApplication = LoanApplication::create($validatedData);

      return response()->json(['status' => true, 'message' => 'Loan Application created successfully!', 'data' => $loanApplication]);
    }
    //show function
    public function show($id)
    {
      if ($id == 0 || empty($id)) {
        $data = db::select(
          "SELECT *,  loan_applications.id as loanid 
           FROM loan_applications
           INNER JOIN clients ON loan_applications.clientid = clients.id"
      );
      
        return response()->json(['status' => true, 'data' => $data]);
    } else {
      $title = "Loan Application Details";
$client = db::select(
    "SELECT *, loan_applications.id as loanid
     FROM loan_applications
     INNER JOIN clients ON loan_applications.clientid = clients.id
     WHERE loan_applications.id = ?", [$id]
);

foreach ($client as $client) {
    if ($client->client_pic) {
        $clientPicPath = str_replace('storage/', '', $client->client_pic);
        if (Storage::disk('public')->exists($clientPicPath)) {
            $clientPicContent = Storage::disk('public')->get($clientPicPath);
            $client->client_pic_base64 = 'data:image/' . pathinfo($clientPicPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($clientPicContent);
        }
    }

    if ($client->client_add_sketch) {
        $clientAddSketchPath = str_replace('storage/', '', $client->client_add_sketch);
        if (Storage::disk('public')->exists($clientAddSketchPath)) {
            $clientAddSketchContent = Storage::disk('public')->get($clientAddSketchPath);
            $client->client_add_sketch_base64 = 'data:image/' . pathinfo($clientAddSketchPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($clientAddSketchContent);
        }
    }
}

$data = [$client];
return view('loanapplication.viewdetails', compact('data', 'title'));

         
    }
    }
    //edit function
    public function edit($id)
    {
      $title = 'Edit Loan Application';
        $loan = LoanApplication::findOrFail($id);
        $clients = Client::all();
        return view('loanapplication.addnewapplication', compact('loan','clients', 'title'));
    }
    //update function
    public function update(Request $request, $id)
    {
    }
    //destroy function
    public function destroy($id)
    {
    }


}
