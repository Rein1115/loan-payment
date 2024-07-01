<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->menus();

        return view('User.user-list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // return $request;
        try {
            // Define validation rules
            $validator = Validator::make($request->all(), [
                'firstname' => ['required', 'string', 'max:255'],
                'middlename' => ['nullable', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users,username'],
                'password' => ['required', 'string', 'min:8'],
                'confirmpassword' => ['required', 'string', 'min:8'],
                'account_type' => ['required', 'string', 'max:255'],
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'response' => $validator->errors()
                ], 200);
            }else{
                if($request->password != $request->confirmpassword){
                    return response()->json([
                        'success' => false,
                        'response' => 'Not same password'
                    ], 200);
                }
                else{
                    $user = new User();
                    $user->firstname = $request->firstname;
                    $user->middlename = $request->middlename;
                    $user->lastname = $request->lastname;
                    $user->username = $request->username;
                    $user->password = bcrypt($request->password); 
                    $user->account_type = $request->account_type;
                    $user->save();

                    // Return a success response
                    return response()->json([
                        'success' => true,
                        'response' => 'User created successfully',
                        'user' => $user
                    ], 201);
                }

               
            }
        }catch(Exception $e){
            return response()->json(['success' => false, 'response' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        try{

            
            if($id == 0){
                $users = User::all();
                return response()->json(['success' => true, 'response' => $users], 200);
            }
            else{
                $user = User::find($id);
                return response()->json(['success' => true, 'response' => $user], 200);
            }
        }
            catch(Exception $e){
                return response()->json(['success' => false,'response' => $e->getMessage()], 500);
            }
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Define validation rules
            $validator = Validator::make($request->all(), [
                'firstname' => ['required', 'string', 'max:255'],
                'middlename' => ['nullable', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255'],
                'account_type' => ['required', 'string', 'max:255'],
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'response' => $validator->errors()
                ], 200);
            }else{
                
                    $user = User::find($id);


                    $user->firstname = $request->firstname;
                    $user->middlename = $request->middlename;
                    if(isset($user->password)){
                        $user->password = bcrypt($request->password); 
                    }
                    $user->lastname = $request->lastname;
                    $user->username = $request->username;
                      $user->account_type = $request->account_type;
                    $user->save();

                    // Return a success response
                    return response()->json([
                        'success' => true,
                        'response' => 'User Updated successfully',
                        'user' => $user
                    ], 201);
          


            }
        }catch(Exception $e){
            return response()->json(['success' => false, 'response' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
