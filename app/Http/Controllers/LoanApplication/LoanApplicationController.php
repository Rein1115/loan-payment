<?php

namespace App\Http\Controllers\LoanApplication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Validator;

class LoanApplicationController extends Controller
{
  //resource functions


    //index function
    public function index()
    {
        // resource functions
        $data = $this->menus();
        return view('loanapplication.index', compact('data'));
    }
    //create function
    public function create()
    {
    }
    //store function
    public function store(Request $request)
    {
    }
    //show function
    public function show($id)
    {
    }
    //edit function
    public function edit($id)
    {
    }
    //update function
    public function update(Request $request, $id)
    {
    }
    //destroy function
    public function destroy($id)
    {
    }


}
