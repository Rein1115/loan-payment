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
        $menu['usermodules'] = DB::select('SELECT um.* , mm.id as u_id,mm.description as u_desc, mm.icon as u_icon  FROM usermodules as um LEFT JOIN menu_modules as mm ON um.mmodules_id = mm.id WHERE um.user_id = '.Auth::user()->id.'');

        if($menu['usermodules']){
            for($um = 0; $um < count($menu['usermodules']); $um++){
                // return $menu['usermodules'][$um];
                $function = [];
                $menu['userfunctions'] = DB::select('SELECT mf.* FROM userfunctions as uf LEFT JOIN menu_functions as mf ON uf.mfunctions_id = mf.id WHERE uf.mmodules_id = ? AND uf.user_id = ?', [$menu['usermodules'][$um]->u_id, Auth::user()->id]);


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

            return $data;
        }else{
            return response()->json(['ts'=>'wala']);
        }
    }
}
