<?php


use App\Report;
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index(){

    	return response(\App\Report::latest()->get(), 200);
    
    }

    public function store(Request $request){
    	
    	 $data = $request->validate([
	        'name' => 'required',
	        'description' => 'required' 
	    ]);

    	$report = \App\Report::create($data);

    	return response($report, 201);
    }
}
