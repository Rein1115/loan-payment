<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Client;
use Auth;
class ClientController extends Controller
{
	public function index()
    {
        $desc = 'Client';    
        $type = Auth::user()->account_type;
        $response = $this->authencation($desc);

        if(!empty($response['function']['function']) ||  !empty($response['description']->type === $type)){
            $data = $this->menus();
            return view('client.index', compact('data'));
        }
        else{
            return view('pages-error-404');
        }
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $desc = 'Client';    
        $type = Auth::user()->account_type;
        $response = $this->authencation($desc);

        if(!empty($response['function']['function']) ||  !empty($response['description']->type === $type)){
            $data = $this->menus();
            $title = 'Add Client';
            return view('client.addClient', compact('title', 'data'));
        }
        else{
            return view('pages-error-404');
        }
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
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
        'client_pic' => 'required',
        'client_add_sketch' => 'required',
    ]);

    if ($validator->fails()) {
        $errors = $validator->errors();
        $errorMessages = '';
        
        foreach ($errors->all() as $message) {
            $errorMessages .= $message . ' ';
        }
        
        return response()->json(['status' => false, 'message' => $errorMessages]);
            }

    $validatedData = $validator->validated();

    // Ensure no array values are passed
    foreach ($validatedData as $key => $value) {
        if (is_array($value)) {
            $validatedData[$key] = implode(',', $value); // Convert array to string
        }
    }

    // Handle Base64 encoded file uploads
    if ($request->get('client_pic')) {
        $clientPicBase64 = $request->get('client_pic');
        $clientPic = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $clientPicBase64));
        $clientPicFilename = time() . rand(10000, 99999) . '.png'; // Assuming the file is a PNG image
        $clientPicPath = 'client_pic/' . $clientPicFilename;
        Storage::disk('public')->put($clientPicPath, $clientPic);
        $validatedData['client_pic'] = 'storage/' . $clientPicPath;
    }

    if ($request->get('client_add_sketch')) {
        $clientAddSketchBase64 = $request->get('client_add_sketch');
        $clientAddSketch = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $clientAddSketchBase64));
        $clientAddSketchFilename = time() . rand(10000, 99999) . '.png'; // Assuming the file is a PNG image
        $clientAddSketchPath = 'client_sketch/' . $clientAddSketchFilename;
        Storage::disk('public')->put($clientAddSketchPath, $clientAddSketch);
        $validatedData['client_add_sketch'] = 'storage/' . $clientAddSketchPath;
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

        $desc = 'Client';    
        $type = Auth::user()->account_type;
        $response = $this->authencation($desc);

        if(!empty($response['function']['function']) ||  !empty($response['description']->type === $type)){
         

        $title = 'Edit Client';
        $client = Client::findOrFail($id);
    
        // Convert image paths to base64 encoded strings if they exist
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
    
        return view('client.addClient', compact('client', 'title'));

        }
        else{
            return view('pages-error-404');
        }


        


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
            'client_pic' => 'required',
            'client_add_sketch' => 'required',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = '';
            
            foreach ($errors->all() as $message) {
                $errorMessages .= $message . ' ';
            }
            
            return response()->json(['status' => false, 'message' => $errorMessages]);
                    }
    
        $validatedData = $validator->validated();
    
        // Ensure no array values are passed
        foreach ($validatedData as $key => $value) {
            if (is_array($value)) {
                $validatedData[$key] = implode(',', $value); // Convert array to string
            }
        }
    
        // Handle Base64 encoded file uploads
        if ($request->get('client_pic')) {
            $clientPicBase64 = $request->get('client_pic');
            $clientPic = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $clientPicBase64));
            $clientPicFilename = time() . rand(10000, 99999) . '.png'; // Assuming the file is a PNG image
            $clientPicPath = 'client_pic/' . $clientPicFilename;
            Storage::disk('public')->put($clientPicPath, $clientPic);
            $validatedData['client_pic'] = 'storage/' . $clientPicPath;
        }
    
        if ($request->get('client_add_sketch')) {
            $clientAddSketchBase64 = $request->get('client_add_sketch');
            $clientAddSketch = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $clientAddSketchBase64));
            $clientAddSketchFilename = time() . rand(10000, 99999) . '.png'; // Assuming the file is a PNG image
            $clientAddSketchPath = 'client_sketch/' . $clientAddSketchFilename;
            Storage::disk('public')->put($clientAddSketchPath, $clientAddSketch);
            $validatedData['client_add_sketch'] = 'storage/' . $clientAddSketchPath;
        }
    
        // Update the client record
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['status' => false, 'message' => 'Client not found.']);
        }
    
        $client->update($validatedData);
    
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
