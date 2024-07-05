<?php

namespace App\Http\Controllers\Collector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collector;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Validator;
use Auth;
class CollectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   

        $desc = "Collector";

        $response = $this->Auth($desc);
        if($response){
            $data = $this->menus();
            $datas = DB::select('SELECT c.id as ids,c.* , a.* FROM collectors as c INNER JOIN areas as a ON c.areaid = a.id');

            if($request->ajax()){
                return response()->json(['success' => true, 'response' => $datas]);
            }
            return view('collector.collector-list',compact('data'));
        }else{
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
        try {
            // Define validation rules
            $validator = Validator::make($request->all(), [
                'fname' => ['required', 'string'],
                'mname' => ['nullable', 'string'],
                'lname' => ['required', 'string'],
                'fullname' => ['required', 'string'],
                'areaid' => ['required', 'integer', 'unique:collectors,areaid'],
            ]);
            

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'response' => $validator->errors()
                ], 200);
            }else{
                    $collector = new Collector();
                    $collector->fname = $request->fname;
                    $collector->mname = $request->mname;
                    $collector->lname = $request->lname;
                    $collector->fullname = $request->fullname;
                    $collector->areaid = $request->areaid;
                    $collector->save();
                    // Return a success response
                    return response()->json([
                        'success' => true,
                        'response' => 'Collector created successfully',
                        'user' => $collector
                    ], 201); 
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
     
        try {
            $data = DB::select('SELECT c.id as ids,c.*, a.* FROM collectors as c INNER JOIN areas as a ON c.areaid = a.id WHERE c.id = ?', [$id]);
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
        //
        try {
            // Define validation rules
            $validator = Validator::make($request->all(), [
                'fname' => ['required', 'string'],
                'mname' => ['nullable', 'string'],
                'lname' => ['required', 'string'],
                'fullname' => ['required', 'string'],
                'areaid' => ['required', 'integer'],
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'response' => $validator->errors()
                ], 200);
            }else{
                    $collector = Collector::find($id);
                    $collector->fname = $request->fname;
                    $collector->mname = $request->mname;
                    $collector->lname = $request->lname;
                    $collector->fullname = $request->fullname;
                    $collector->areaid = $request->areaid;
                    $collector->save();
                    // Return a success response
                    return response()->json([
                        'success' => true,
                        'response' => 'Collector Updated successfully',
                        'user' => $collector
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
     
    }
}
