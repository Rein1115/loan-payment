<?php

namespace App\Http\Controllers\menumodule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menumodule;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;



class MenumoduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        
        $desc = 'MenuModules';
        $type = Auth::user()->account_type;
        $response = $this->authencation($desc);

        if(!empty($response['function']['function']) ||  $response['description']->type === $type){
            $data = $this->menus();
    
            if($request->ajax()){
                $data = Menumodule::all();

                return response()->json(['success' => true,'response' => $data]);
            }
                return view('menumodule.menumodule-list',compact('data'));
        }
        else{
            return view('pages-error-404');
        }
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
        //
        try{
            $validator = Validator::make($request->all(), [
                'description' => ['required', 'string'],
                'icon' => ['required', 'string'],
                'route' => ['required', 'string'],
                'sort' => ['required', 'integer'],
                'type' => ['required', 'string']
            ]);


                if($validator->fails()){
                    return response()->json(['success' => false , 'response' => $validator->errors()]);
                }
                else{
                    Menumodule::insert($request->all());

                    return response()->json(['success' => true , 'response' =>'Menu module inserted successfully']);
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
        //
        try {
            $data = DB::select('SELECT * FROM menumodules WHERE id = ?', [$id]);
            return response()->json(['success' => true, 'response' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'response' => $e->getMessage()], 401);
        }
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
       

        // return $id;
        try {
            $validator = Validator::make($request->all(), [
                'description' => ['required', 'string'],
                'icon' => ['required', 'string'],
                'route' => ['required', 'string'],
                'sort' => ['required', 'integer'],
                'type' => ['required', 'string']
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false , 'response' => $validator->errors()]);
            } else {
                $menuModule = Menumodule::find($id);
                if (!$menuModule) {
                    return response()->json(['success' => false , 'response' => 'Menu module not found']);
                }
                $menuModule->update($request->all());
                return response()->json(['success' => true , 'response' => 'Menu module updated successfully']);
            }
            
        } catch(Exception $e) {
            return response()->json(['success' => false, 'response' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            // Find the Menumodule by ID
            $menuModule = Menumodule::find($id);
    
            if (!$menuModule) {
                return response()->json(['success' => false , 'response' => 'Menu module not found']);
            }
    
            // Delete the Menumodule
            $menuModule->delete();
    
            return response()->json(['success' => true , 'response' => 'Menu module deleted successfully']);
            
        } catch(Exception $e) {
            return response()->json(['success' => false, 'response' => $e->getMessage()]);
        }
    }
}