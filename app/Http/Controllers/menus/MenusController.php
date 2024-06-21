<?php

namespace App\Http\Controllers\menus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];

   
            $menu['usermodules'] = DB::select('SELECT um.* , mm.id as u_id,mm.description as u_desc, mm.icon as u_icon  FROM usermodules as um LEFT JOIN menu_modules as mm ON um.mmodules_id = mm.id WHERE um.user_id = '.Auth::user()->id.'');

            if($menu['usermodules']){
                for($um = 0; $um < count($menu['usermodules']); $um++){
                    // return $menu['usermodules'][$um];
                    $function = [];
                    $menu['userfunctions'] = DB::select('SELECT mf.* FROM userfunctions as uf LEFT JOIN menu_functions as mf ON uf.mfunctions_id = mf.id WHERE uf.mmodules_id = '.$menu['usermodules'][$um]->u_id.'' );
    
                    for($uf = 0; $uf<count($menu['userfunctions']); $uf++){
                        $function[$uf] = [
                            "description" => $menu['userfunctions'][$uf]->description,
                            "icon" => $menu['userfunctions'][$uf]->icon,
                            "route" => $menu['userfunctions'][$uf]->route
                        ] ;
                    }
                    $data [$um] = [
                        "description" => $menu['usermodules'][$um]->u_desc,
                        "icon" => $menu['usermodules'][$um]->u_icon,
                        "function" => $function
                    ];
                }
                dd($data);
                return view('home',compact('data'));

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
