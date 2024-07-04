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




    public function authencation(string $desc){
        $type = Auth::user()->account_type;
        $user = Auth::user()->id;

        $function = [];
        $function = DB::select('SELECT * FROM menufunctions WHERE description = ?  OR type =?  ', [$desc,$type]);
       
        $response = [];
        $users = [];

  
        for($i = 0; $i<count($function); $i++){
            $usermenu = DB::select('SELECT * FROM usermodules WHERE mmodules_id = ? AND user_id =?', [$function[$i]->mmodules_id ,  $user ]);
          
            for($f =0 ; $f<count($usermenu); $f++){
                $userfunction = DB::select('SELECT mf.id,uf.mmodules_id FROM userfunctions AS uf INNER JOIN menufunctions AS mf ON mf.id = uf.mfunctions_id  WHERE uf.mmodules_id = ? AND uf.user_id = ? ' , [$usermenu[$f]->mmodules_id,$user]);
                $users = [
                    "usermenu" => $usermenu[$f],
                ];

                $usersf = [];
                for($uf = 0; $uf<count($userfunction); $uf++){
                    $usersf = [
                        "function" => isset($userfunction[$uf]) ? $userfunction[$uf] : []
                    ];
                }
            }

            $response = [
                "description" => isset($function[$i]) ? $function[$i]: []  ,
                "usermenu" => $users,
                "function" => isset($usersf) ? $usersf : []
             ];
        }
        return $response;
    }
    
}