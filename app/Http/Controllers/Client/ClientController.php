<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Validator;

class ClientController extends Controller
{
    public function index(){

        $data = $this->menus();
		return view('client.index',compact('data'));;
	}

	public function list(){
		$client = Client::get();
		return response()->json(['status' => true, 'data' => $client ]);
	}

	public function save(Request $request, $id = ""){

        dd($request);

		$validator = Validator::make($request->all(), [
			'firstname' => 'required',
			'middlename' => 'required',
			'lastname' => 'required',
			'dob' => 'required',
			'gender' => 'required',
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

		if($validator->fails()){
			return response()->json(['status' => false, 'error' => $validator->errors() ]);
		}else{
			if(!empty($id)){
				$client = Client::where('id', $id)->update([
					'firstname' => $request->get('firstname'),
					'middlename' => $request->get('middlename'),
					'lastname' => $request->get('lastname'),
					'dob' => $request->get('dob'),
					'gender' => $request->get('gender'),
					'edu_att' => $request->get('edu_att'),
					'religion' => $request->get('religion'),
					'present_add' => $request->get('present_add'),
					'prov_add' => $request->get('prov_add'),
					'salary_income' => $request->get('salary_income'),
					'occupation' => $request->get('occupation'),
					'nameOfBusiness' => $request->get('nameOfBusiness'),
					'addOfBusiness' => $request->get('addOfBusiness'),
					'mo_income' => $request->get('mo_income'),
					'contact_no' => $request->get('contact_no'),
					'otherLoan' => $request->get('otherLoan'),
					'sp_name' => $request->get('sp_name'),
					'sp_add' => $request->get('sp_add'),
					'sp_occupation' => $request->get('sp_occupation'),
					'sp_salary' => $request->get('sp_salary'),
					'no_dependents' => $request->get('no_dependents'),
					'sp_contact' => $request->get('sp_contact'),
					'sp_children' => $request->get('sp_children'),
					'client_pic' => $request->get('client_pic'),
					'client_add_sketch' => $request->get('client_add_sketch'),
				]);
				if($client){
					return response()->json(['status' => true, 'message' => 'client saved successfully!']);
				}
			}else{
				$client = Client::create([
					'firstname' => $request->get('firstname'),
					'middlename' => $request->get('middlename'),
					'lastname' => $request->get('lastname'),
					'dob' => $request->get('dob'),
					'gender' => $request->get('gender'),
					'edu_att' => $request->get('edu_att'),
					'religion' => $request->get('religion'),
					'present_add' => $request->get('present_add'),
					'prov_add' => $request->get('prov_add'),
					'salary_income' => $request->get('salary_income'),
					'occupation' => $request->get('occupation'),
					'nameOfBusiness' => $request->get('nameOfBusiness'),
					'addOfBusiness' => $request->get('addOfBusiness'),
					'mo_income' => $request->get('mo_income'),
					'contact_no' => $request->get('contact_no'),
					'otherLoan' => $request->get('otherLoan'),
					'sp_name' => $request->get('sp_name'),
					'sp_add' => $request->get('sp_add'),
					'sp_occupation' => $request->get('sp_occupation'),
					'sp_salary' => $request->get('sp_salary'),
					'no_dependents' => $request->get('no_dependents'),
					'sp_contact' => $request->get('sp_contact'),
					'sp_children' => $request->get('sp_children'),
					'client_pic' => $request->get('client_pic'),
					'client_add_sketch' => $request->get('client_add_sketch'),
				]);
				if($client){
					return response()->json(['status' => true, 'message' => 'client updated successfully!']);
				}
			}
		}
	}

	public function edit($id){
		$title = 'Edit Client';
		$client = Client::findOrFail($id);
		return view('client.addClient', compact('client', 'title'));
	}

	public function add(){
        $data = $this->menus();

		$title = 'Add Client';
		return view('client.addClient', compact('title', 'data'));
	}

	public function find($id){
		$client = Client::findOrFail($id);
		return response()->json(['status' => true, 'data' => $client ]);
	}

	public function delete($id){
		$client = Client::findOrFail($id);
		if($client->delete()){
			return response()->json(['status' => true, 'message' => 'Record deleted successfully!' ]);
		}
	}
}
