<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Validator;

class ClientController extends Controller
{
	public function index()
    {
        $data = $this->menus();
        return view('client.index', compact('data'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $data = $this->menus();
        $title = 'Add Client';
        return view('client.addClient', compact('title', 'data'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {

		// \Log::info('Incoming request data:', $request->all());
		// \Log::info('Request data types:', array_map('gettype', $request->all()));

		$validator = Validator::make($request->all(), [
			'firstname' => 'required',
			'middlename' => 'required',
			'lastname' => 'required',
			'dob' => 'required',
			'gender' => 'required',
			'civil_status' => 'required',
			'edu_att' => 'required',
			'religion' => 'required',
			'present_add' => 'required',
			'prov_add' => 'required',
			'salary_income' => 'required',
			'occupation' => 'required',
			'nameOfBusiness' => 'nullable',
			'addOfBusiness' => 'nullable',
			'mo_income' => 'nullable',
			'contact_no' => 'nullable',
			'otherLoan' => 'nullable',
			'sp_name' => 'nullable',
			'sp_add' => 'nullable',
			'sp_occupation' => 'nullable',
			'sp_salary' => 'nullable',
			'no_dependents' => 'nullable',
			'sp_contact' => 'nullable',
			'sp_children' => 'nullable',
			'client_pic' => 'nullable',
			'client_add_sketch' => 'nullable',
		]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'error' => $validator->errors()]);
		}

		$validatedData = $validator->validated();

		// Ensure no array values are passed
		foreach ($validatedData as $key => $value) {
			if (is_array($value)) {
				$validatedData[$key] = implode(',', $value); // Convert array to string
			}
		}

		$client = Client::create($validatedData);

		return response()->json(['status' => true, 'message' => 'Client created successfully!', 'data' => $client]);

    }

    // Display the specified resource.
    public function show(Request $request, $id = null)
    {
        if ($id == 0 || empty($id)) {
            $clients = Client::all();
            return response()->json(['status' => true, 'data' => $clients]);
        } else {
            $client = Client::findOrFail($id);
            return response()->json(['status' => true, 'data' => $client]);
        }
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $title = 'Edit Client';
        $client = Client::findOrFail($id);
        return view('client.addClient', compact('client', 'title'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'civil_status' => 'required',
            'edu_att' => 'required',
            'religion' => 'required',
            'present_add' => 'required',
            'prov_add' => 'required',
            'salary_income' => 'required',
            'occupation' => 'required',
            'nameOfBusiness' => 'nullable',
            'addOfBusiness' => 'nullable',
            'mo_income' => 'nullable',
            'contact_no' => 'nullable',
            'otherLoan' => 'nullable',
            'sp_name' => 'nullable',
            'sp_add' => 'nullable',
            'sp_occupation' => 'nullable',
            'sp_salary' => 'nullable',
            'no_dependents' => 'nullable',
            'sp_contact' => 'nullable',
            'sp_children' => 'nullable',
            'client_pic' => 'nullable',
            'client_add_sketch' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => $validator->errors()]);
        }

        $client = Client::where('id', $id)->update($request->all());

        return response()->json(['status' => true, 'message' => 'Client updated successfully!', 'data' => $client]);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        if ($client->delete()) {
            return response()->json(['status' => true, 'message' => 'Record deleted successfully!']);
        }
    }
    // public function index(){

    //     $data = $this->menus();
	// 	return view('client.index',compact('data'));;
	// }

	// public function list(){
	// 	$client = Client::all();
	// 	return response()->json(['status' => true, 'data' => $client ]);
	// }

	// public function save(Request $request, $id){


	// 	$validator = Validator::make($request->all(), [
	// 		'firstname' => 'required',
	// 		'middlename' => 'required',
	// 		'lastname' => 'required',
	// 		'dob' => 'required',
	// 		'gender' => 'required',
	// 		'civil_status' => 'required',
	// 		'edu_att' => 'required',
	// 		'religion' => 'required',
	// 		'present_add' => 'required',
	// 		'prov_add' => 'required',
	// 		'salary_income' => 'required',
	// 		'occupation' => 'required',
	// 		'nameOfBusiness' => 'nullable',
	// 		'addOfBusiness' => 'nullable',
	// 		'mo_income' => 'nullable',
	// 		'contact_no' => 'nullable',
	// 		'otherLoan' => 'nullable',
	// 		'sp_name' => 'nullable',
	// 		'sp_add' => 'nullable',
	// 		'sp_occupation' => 'nullable',
	// 		'sp_salary' => 'nullable',
	// 		'no_dependents' => 'nullable',
	// 		'sp_contact' => 'nullable',
	// 		'sp_children' => 'nullable',
	// 		'client_pic' => 'nullable',
	// 		'client_add_sketch' => 'nullable',
	// 	]);

	// 	if($validator->fails()){
	// 		return response()->json(['status' => false, 'error' => $validator->errors() ]);
	// 	}else{
	// 		if($id != '0'){
	// 			$client = Client::where('id', $id)->update([
	// 				'firstname' => $request->get('firstname'),
	// 				'middlename' => $request->get('middlename'),
	// 				'lastname' => $request->get('lastname'),
	// 				'dob' => $request->get('dob'),
	// 				'gender' => $request->get('gender'),
	// 				'civil_status' => $request->get('civil_status'),
	// 				'edu_att' => $request->get('edu_att'),
	// 				'religion' => $request->get('religion'),
	// 				'present_add' => $request->get('present_add'),
	// 				'prov_add' => $request->get('prov_add'),
	// 				'salary_income' => $request->get('salary_income'),
	// 				'occupation' => $request->get('occupation'),
	// 				'nameOfBusiness' => $request->get('nameOfBusiness'),
	// 				'addOfBusiness' => $request->get('addOfBusiness'),
	// 				'mo_income' => $request->get('mo_income'),
	// 				'contact_no' => $request->get('contact_no'),
	// 				'otherLoan' => $request->get('otherLoan'),
	// 				'sp_name' => $request->get('sp_name'),
	// 				'sp_add' => $request->get('sp_add'),
	// 				'sp_occupation' => $request->get('sp_occupation'),
	// 				'sp_salary' => $request->get('sp_salary'),
	// 				'no_dependents' => $request->get('no_dependents'),
	// 				'sp_contact' => $request->get('sp_contact'),
	// 				'sp_children' => $request->get('sp_children'),
	// 				'client_pic' => $request->get('client_pic'),
	// 				'client_add_sketch' => $request->get('client_add_sketch'),
	// 			]);
	// 			if($client){
	// 				return response()->json(['status' => true, 'message' => 'client saved successfully!']);
	// 			}
	// 		}else{
	// 			$client = Client::create([
	// 				'firstname' => $request->get('firstname'),
	// 				'middlename' => $request->get('middlename'),
	// 				'lastname' => $request->get('lastname'),
	// 				'dob' => $request->get('dob'),
	// 				'gender' => $request->get('gender'),
	// 				'civil_status' => $request->get('civil_status'),
	// 				'edu_att' => $request->get('edu_att'),
	// 				'religion' => $request->get('religion'),
	// 				'present_add' => $request->get('present_add'),
	// 				'prov_add' => $request->get('prov_add'),
	// 				'salary_income' => $request->get('salary_income'),
	// 				'occupation' => $request->get('occupation'),
	// 				'nameOfBusiness' => $request->get('nameOfBusiness'),
	// 				'addOfBusiness' => $request->get('addOfBusiness'),
	// 				'mo_income' => $request->get('mo_income'),
	// 				'contact_no' => $request->get('contact_no'),
	// 				'otherLoan' => $request->get('otherLoan'),
	// 				'sp_name' => $request->get('sp_name'),
	// 				'sp_add' => $request->get('sp_add'),
	// 				'sp_occupation' => $request->get('sp_occupation'),
	// 				'sp_salary' => $request->get('sp_salary'),
	// 				'no_dependents' => $request->get('no_dependents'),
	// 				'sp_contact' => $request->get('sp_contact'),
	// 				'sp_children' => $request->get('sp_children'),
	// 				'client_pic' => $request->get('client_pic'),
	// 				'client_add_sketch' => $request->get('client_add_sketch'),
	// 			]);
	// 			if($client){
	// 				return response()->json(['status' => true, 'message' => 'client created successfully!']);
	// 			}
	// 		}
	// 	}
	// }

	// public function edit($id){
	// 	$title = 'Edit Client';
	// 	$client = Client::findOrFail($id);
	// 	return view('client.addClient', compact('client', 'title'));
	// }

	// public function add(){
    //     $data = $this->menus();

	// 	$title = 'Add Client';
	// 	return view('client.addClient', compact('title', 'data'));
	// }

	// public function find($id){
	// 	$client = Client::findOrFail($id);
	// 	return response()->json(['status' => true, 'data' => $client ]);
	// }

	// public function delete($id){
	// 	$client = Client::findOrFail($id);
	// 	if($client->delete()){
	// 		return response()->json(['status' => true, 'message' => 'Record deleted successfully!' ]);
	// 	}
	// }
}
