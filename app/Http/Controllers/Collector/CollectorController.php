<?php

namespace App\Http\Controllers\Collector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collector;
use Illuminate\Support\Facades\DB;
use Exception;
class CollectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $data = DB::select('SELECT c.id as ids,c.* , a.* FROM collectors as c INNER JOIN areas as a ON c.areaid = a.id');

        if($request->ajax()){
            return response()->json(['success' => true, 'response' => $data]);
        }

        return view('collector.collector-list');
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
