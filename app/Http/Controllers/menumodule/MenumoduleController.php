<?php

namespace App\Http\Controllers\menumodule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;



class MenumoduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $data = $this->menus();


        if($request->ajax()){
            $data = DB::select('SELECT * FROM menu_modules');



            return response()->json(['success' => true,'response' => $data]);
        }



        return view('menumodule.menumodule-list',compact('data'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
