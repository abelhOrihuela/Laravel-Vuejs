<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Candidate;

class CandidatesController extends Controller
{

	/**
    * Select all Candidates
    *
    * @param int $num_rows
    * @param int $user_id
    * @param string $search_term
    * @return Array[] Object:Candidates
    */

    function index(){

    	$candidates=Candidate::all();

    	foreach ($candidates as $candidate) {
    		$candidate->experiences;
        }
    	return $candidates;
    }

    /**
    * Select one Candidate
    *
    * @param int $id: id candidate
    * @return Object:Candidate
    */

    function show($id){
    	$candidate=Candidate::where("id", "=", $id)->first();
    	$log=$candidate->experiences;
    	return $candidate;
    }

    function create(Request $request){
    }
}
