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
			$candidate->categoryCandidate;
			$candidate->subcategoryCandidate;
			$candidate->photo;
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
		$candidate->experiences;
		$candidate->categoryCandidate;
		$candidate->subcategoryCandidate;
		$candidate->photo;


		return $candidate;
	}

	function create(Request $request){

		$day=0;
		$month=0;
		$year=0;

		$birthday=$request->birthday;

		//list($year, $month, $day) = explode("-", $birthday);

		$candidate= new Candidate();

		$candidate->username=$request->username;
		$candidate->gender=$request->gender;
		$candidate->email=$request->email;
		$candidate->location=$request->location;

		$candidate->day=$day;
		$candidate->month=$month;
		$candidate->year=$year;

		$candidate->code=$request->code;
		$candidate->phone=$request->phone;
		$candidate->position=$request->position;
		$candidate->category=$request->category;
		$candidate->subcategory=$request->subcategory;


		if($candidate->save()){
			return  $candidate->id;
		}else{
			abort(404);
		}
	}
}
