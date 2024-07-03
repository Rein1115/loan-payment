<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getAreas(string $areacode){

        try{
            $ares;
            if($areacode != 0){
            $are = Area::where('areacode', $areacode)->get();
            $distinctAreas = Area::distinct()->get();

            return response()->json([
                'success' => true,
                'belong' => $are,
                'areas' => $distinctAreas,
                'areacode' => $areacode
            ], 200);
            }
            else{
                $distinctAreas = Area::select('areacode', 'id')->distinct()->get();

            return response()->json([
                'all' => 'all',
                'success' => true,
                'areas' => $distinctAreas
            ], 200);
            }

        }
        catch(Exception $e){
            return response()->json(['success' => false, 'response' => $e->getMessage()]);

        }
    }

    public function getArea(string $areacode){
    }

    public function menus(){
        $data = [];
        $userId = Auth::user()->id;
        $accountType = Auth::user()->account_type;
        
        $menu['usermodules'] = DB::select('SELECT um.*, mm.id as u_id , mm.description as u_desc, mm.icon as u_icon 
            FROM menumodules as mm
            LEFT JOIN usermodules as um ON um.mmodules_id = mm.id AND um.user_id = ?
            WHERE ( mm.type = ? OR um.user_id IS NOT NULL) 
        ', [$userId, $accountType]);
            for($um = 0; $um < count($menu['usermodules']); $um++){
                // dd($menu['usermodules'][$um]);
                // return $menu['usermodules'][$um];
                $function = [];
                
            $menu['userfunctions'] = DB::select('SELECT mf.* 
                FROM menufunctions AS mf 
                LEFT JOIN userfunctions AS uf ON mf.id = uf.mfunctions_id AND uf.user_id = ?
                WHERE mf.mmodules_id = ? AND (mf.type = ? OR uf.user_id IS NOT NULL)
            ', [$userId, $menu['usermodules'][$um]->u_id, $accountType]);
                
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
            // dd($data);
            return $data;
      
    }

    // public function Userauth(){
    //     // $userId = Auth::user()->id;
    //     // $userType = Auth::user()->type;
    //          $userId = 0;
    //     $userType = 'cashier';


    //     $acc['users'] = DB::select('SELECT * FROM users');

    //     $response = [];
    //     $menumod= [];
    //     $userfunction = [];
    //     for($u = 0; $u<count($acc['users']); $u++){

    //         $acc['menumodules'] = DB::select('SELECT * FROM menumodules WHERE type = ?' , [$acc['users'][$u]->account_type]);

    //         for($mm = 0 ; $mm < count($acc['menumodules']); $mm++){
    //             $acc['menufunctions'] = DB::select('SELECT * FROM menufunctions WHERE mmodules_id =? ',[$acc['menumodules'][$mm]->id]); 

    //             $acc['usermodule'] = DB::select('SELECT * FROM usermodules WHERE user_id = ? AND mmodules_id = ? ', [$userId,$acc['users'][$u]->id]);

    //             for($um = 0; $um < count($acc['usermodule']); $um++){
    //                 $acc['userfunction'] = DB::select('SELECT * FROM userfunctions WHERE mmodules_id = ? AND type = ? ' , [$acc['usermodule'][$um]->id,$userId]);

    //                 $userfunction[$um] = [
    //                     "userfunction" => $acc['userfunction'][$um]->id,
    //                     "usermodules" => $acc['usermodule'][$um]->id
    //                 ];
    //             }

    //             $menumod[$mm] = [
    //                 "menufunctions" => $acc['menufunctions'][$mm]->id,
    //                 "userfunction" => $userfunction
                    
    //             ];

    //         }


    //         $response[$u] = [
    //             "user" => $acc['users'][$u]->id,
    //             "menumodules" => $menumod
    //         ];

    //     }


    //     return $response;
    // }
}
