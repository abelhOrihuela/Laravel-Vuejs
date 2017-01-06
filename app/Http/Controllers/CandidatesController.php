<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Candidate;
use Session;
use PDF;
use DB;

class CandidatesController extends Controller
{

	/**
	* Select all Candidates
	* @param int $num_rows
	* @param int $user_id
	* @param string $search_term
	* @return Array[] Object:Candidates
	**/

	function index(){
	$candidates=Candidate::all();

		/*
		$users = DB::table('users')
		->where('votes', '>', 100)
		->orWhere('name', 'John')
		->get();
		*/


		foreach ($candidates as $candidate) {
			//$candidate->experiences;
			//$candidate->experiencesWtc;
			$candidate->categoryCandidate;
			$candidate->subcategoryCandidate;
			$candidate->languages;
			$candidate->idioms;
			$candidate->photo;
			//$candidate->economic;
			//$candidate->academics;
			//$candidate->user;
		}

		return $candidates;
	}

	public function search(Request $request){
		$query="select * from 'candidates' where";
		$params=[];

		if($request->category){
				$query+=' user_id = ';
				array_push($params,18);
		};

		$candidates = DB::select($query, $params);

		$candidatesresult=[];


			 foreach ($candidates as $candidate) {

				 $obj=Candidate::where("id", "=", $candidate->id)->first();

				 $obj->categoryCandidate;
				 $obj->subcategoryCandidate;
				 $obj->languages;
				 $obj->idioms;
				 $obj->photo;

				 array_push($candidatesresult,$obj);

			 }

			 return $candidatesresult;
		//	 return $request;
	}

	/**
	* Select one Candidate
	* @param int $id: id candidate
	* @return Object:Candidate
	*/

	function show($id){
		$candidate=Candidate::where("id", "=", $id)->first();
		$candidate->experiences;
		$candidate->experiencesWtc;
		$candidate->categoryCandidate;
		$candidate->subcategoryCandidate;
		$candidate->languages;
		$candidate->idioms;
		$candidate->economic;
		$candidate->photo;



		$candidate->user;

		return $candidate;
	}


	/**
	* Create one Candidate
	* @param Request
	* @return Object:Candidate
	*/
	function create(Request $request){
		$day=0;
		$month=0;
		$year=0;

		$birthday=$request->birthday;

		if($birthday){
			list($year, $month, $day) = explode("-", $birthday);
		}

		$candidate= new Candidate();
		$candidate->username=$request->username;
		$candidate->gender=$request->gender;
		$candidate->email=$request->email;
		$candidate->location=$request->location;
		$candidate->user_id= Session::get('user_id');
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
		return $request;
	}

	function getPdf($id){

//		$pdf=PDF::loadView('app.candidate');

		$pdf=PDF::loadView('app.candidate')
		->save(public_path().'/my_stored_file.pdf')
		->stream('download.pdf');

		return $pdf;

	}
}
