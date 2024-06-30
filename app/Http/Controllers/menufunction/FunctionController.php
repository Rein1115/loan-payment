<?php

namespace App\Http\Controllers\menufunction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menufunction;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class FunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
 
        $data = $this->menus();
    
        if($request->ajax()){
            $data = DB::select('SELECT mm.description,mf.transNo FROM menufunctions AS mf INNER JOIN menumodules AS mm ON mm.id = mf.mmodules_id GROUP BY   mf.transNo, mm.description');
            return response()->json(['success' => true,'response' => $data]);
        }
            return view('menufunction.menufunction-list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->menus();
        return view('menufunction.menufunction-details',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
      
        $data = $request->data['function'];

        foreach ($data as $item) {
            $validator = Validator::make($item, [
                'description' => ['required', 'string'],
                'icon' => ['required', 'string'],
                'route' => ['required', 'string'],
                'mmodules_id' => ['required', 'integer'],
                'sort' => ['required', 'integer'],
                'type' => ['required', 'string'],
            ]);
        
            if ($validator->fails()) {
                return response()->json(['success' => false, 'response' => $validator->errors()]);
            }
        }

        $lastTransNo = Menufunction::max('transNo')+1;

        foreach ($data as $item) {
            Menufunction::create([
                'transNo' =>  empty($lastTransNo) ? 1 : $lastTransNo,
                'description' => $item['description'],
                'icon' => $item['icon'],
                'route' => $item['route'],
                "mmodules_id" => $item['mmodules_id'],
                "sort" => $item['sort'],
                'type' => $item['type'],
            ]);
        }
        
        return response()->json(['success' => true, 'response' => 'Menu functions inserted successfully']);
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $data = DB::select('SELECT mf.* FROM menufunctions AS mf INNER JOIN menumodules AS mm ON mm.id = mf.mmodules_id WHERE mf.transNo = ?', [$id]);
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


        

        $data = $request->data['function'];

        foreach ($data as $item) {
            $validator = Validator::make($item, [
                'description' => ['required', 'string'],
                'icon' => ['required', 'string'],
                'route' => ['required', 'string'],
                'sort' => ['required', 'integer'],
                'type' => ['required', 'string'],
            ]);
        
            if ($validator->fails()) {
                return response()->json(['success' => false, 'response' => $validator->errors()]);
            }
        }
        $transdelete = Menufunction::find($id);
        $transdelete->delete();

        $lastTransNo = Menufunction::max('transNo')+1;

        foreach ($data as $item) {
          
            Menufunction::create([
                'transNo' =>  empty($lastTransNo) ? 1 : $lastTransNo,
                'description' => $item['description'],
                'icon' => $item['icon'],
                'route' => $item['route'],
                "sort" => $item['sort'],
                'type' => $item['type'],
         ]);
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
