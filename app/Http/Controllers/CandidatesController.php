<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Candidate;

class CandidatesController extends Controller
{
    function index(){
    	$candidates=Candidate::all();
    	return $candidates;
    }

    function create(Request $request){



    }
}
