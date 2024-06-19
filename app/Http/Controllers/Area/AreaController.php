<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use Illuminate\Support\Facades\Validator;
use Exception; // Import PHP's native Exception class


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('area.area-list');
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
        //  return $request;
         try {
            // Define validation rules
            $validator = Validator::make($request->all(), [
                'addareacode' => ['required', 'string', 'max:255','unique:areas,areacode'],
                'municipality' => ['required', 'string', 'max:255'],
                'barangay' => ['required', 'string', 'max:255'],
                'purok' => ['required', 'string', 'max:255', ],
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'response' => $validator->errors()
                ], 200);
            }else{
                    $user = new Area();
                    $user->areacode = $request->addareacode;
                    $user->municipality = $request->municipality;
                    $user->barangay = $request->barangay;
                    $user->purok = $request->purok;
                    $user->save();

                    // Return a success response
                    return response()->json([
                        'success' => true,
                        'response' => 'Area created successfully',
                        'user' => $user
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


       
        try{
            if($id == 0){
                $areas = Area::all();
                return response()->json(['success' => true, 'response' => $areas], 200);
            }
            else{
                $area = Area::where('id',$id)->first();
                return response()->json(['success' => true, 'response' => $area], 200);
            }
        }
            catch(Exception $e){
                return response()->json(['success' => false,'response' => $e->getMessage()], 500);
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
            // Define validation rules
            $validator = Validator::make($request->all(), [
                'addareacode' => ['required', 'string', 'max:255'],
                'municipality' => ['required', 'string', 'max:255'],
                'barangay' => ['required', 'string', 'max:255'],
                'purok' => ['required', 'string', 'max:255', ],
            ]);
            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'response' => $validator->errors()
                ], 200);
            }else{

                $result = Area::where('areacode', $request->addareacode)->first();
                $area = Area::where('id',$id)->first();
                
                if (!$result) {
                    $area->areacode = $request->addareacode;
                    $area->municipality = $request->municipality;
                    $area->barangay = $request->barangay;
                    $area->purok = $request->purok;
                } elseif ($result->areacode == $area->areacode) {
                    $area->municipality = $request->municipality;
                    $area->barangay = $request->barangay;
                    $area->purok = $request->purok;
                }
                
                $area->save();
                
                return response()->json([
                    'success' => true,
                    'response' => 'Area updated successfully',
                    'user' => $area
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
