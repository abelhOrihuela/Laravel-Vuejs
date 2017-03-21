<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Candidate;
use Session;
use PDF;
use DB;
use Constants;
use Response;
use Utils;

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

		foreach ($candidates as $candidate) {


			if((Session::get('type_user')	==   1) &&
			(Session::get('profile')		==	 Constants::CUSTOMER)){

				$candidate->email   = Constants::NOT_AVAILABE;
				$candidate->code		= Constants::NOT_AVAILABE;
				$candidate->phone		= Constants::NOT_AVAILABE;

			}

			$candidate->categoryCandidate;
			$candidate->subcategoryCandidate;
			$candidate->languages;
			$candidate->idioms;
			$candidate->photo;
			$candidate->groups;

		}

		return $candidates;
	}

	public function search(Request $request){

		$candidates = array();

		$statement="";
		$economic=false;

		if(Utils::validateValue($request->salary_expectation_min)
		&& Utils::validateValue($request->salary_expectation_max)){
			$statement=$statement.Constants::SEARCH_ECONOMIC;
			$economic=true;
		}else{
			$statement=$statement.Constants::SEARCH;
		}

		if(Utils::validateValue($request->category)){
			$statement=$statement.' AND ';
			$statement=$statement.'category.id	=	'.$request->category;
		}



		if(Utils::validateValue($request->subcategory)){
			$statement=$statement.' AND ';
			$statement=$statement.'subcategories.id = '.$request->subcategory;
		}

		if($economic){

			$statement=$statement.' AND ';
			$statement=$statement.'(candidateeconomic.salary_expectation * 1) BETWEEN ';
			$statement=$statement.$request->salary_expectation_min;
			$statement=$statement.' AND ';
			$statement=$statement.$request->salary_expectation_max;

		}


		$result=DB::select(DB::raw($statement));

		return $result;
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
		$candidate->groups;
		$candidate->user;

		if(Session::get('type_user')	==	1 && Session::get('profile')	==	Constants::CUSTOMER){
			$candidate->email  = Constants::NOT_AVAILABE;
			$candidate->code   = Constants::NOT_AVAILABE;
			$candidate->phone  = Constants::NOT_AVAILABE;
		}


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
		$candidate->username = $request->username;
		$candidate->gender   = $request->gender;
		$candidate->email    = $request->email;
		$candidate->location = $request->location;
		$candidate->user_id  = Session::get('user_id');
		$candidate->day      =$day;
		$candidate->month    =$month;
		$candidate->year     =$year;
		$candidate->code     =$request->code;
		$candidate->phone    =$request->phone;
		$candidate->position =$request->position;
		$candidate->category =$request->category;
		$candidate->subcategory=$request->subcategory;

		if($candidate->save()){
			return  $candidate->id;
		}else{
			abort(404);
		}
		return $request;
	}



	function pdf($id){
		ob_start();
		set_time_limit(0);

		$candidate=$this->show($id);

		$pdf =  \App::make('dompdf.wrapper');
		$name=$id.'.pdf';
		$view =  \View::make('pdf.invoice', compact('candidate'))->render();
		$pdf->loadHTML($view)
		->save('pdf/'.$name);
		return $name;
	}
}
