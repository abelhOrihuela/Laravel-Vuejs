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

		foreach ($candidates as $candidate) {



			if(Session::get('type_user')==1 && Session::get('profile')=='C'){
				$candidate->email='No disponible';
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

		$statement="SELECT `candidates`.`id` FROM `candidates`";

		if($request->salary_expectation_min!=null && $request->salary_expectation_min!=''
		&& $request->salary_expectation_max!=null && $request->salary_expectation_max!=''){
			$statement=$statement.",`candidateeconomic`";
		}


		$flagCategory=false;

		if($request->category!='' && $request->category!=null){
			$statement=$statement.'WHERE';
			$statement=$statement.'`category`='.$request->category;
			$flagCategory=true;
		}
		if($request->subcategory!='' && $request->subcategory!=null){
			if(!$flagCategory){

				$statement=$statement.' WHERE ';
			}else{
				$statement=$statement.' AND ';
			}
			$statement=$statement.'`subcategory`='.$request->subcategory;
		}

		if($request->salary_expectation_min!=null && $request->salary_expectation_min!=''
		&& $request->salary_expectation_max!=null && $request->salary_expectation_max!=''){

			if(!$flagCategory){
				$statement=$statement.' WHERE ';
			}else{
				$statement=$statement.' AND ';
			}
			$statement=$statement.'`candidates`.`id`= `candidateeconomic`.`candidate_id` AND `candidateeconomic`.`salary_expectation`>'.$request->salary_expectation_min;
			$statement=$statement.' AND `candidateeconomic`.`salary_expectation`<'.$request->salary_expectation_max;
		}

		$result=DB::select(DB::raw($statement));


		foreach ($result as $candidate) {
			$candidate=Candidate::where("id", "=", $candidate->id)->first();


			if(Session::get('type_user')==1 && Session::get('profile')=='C'){
				$candidate->email='No disponible';
			}

			$candidate->categoryCandidate;
			$candidate->subcategoryCandidate;
			$candidate->languages;
			$candidate->idioms;
			$candidate->photo;
			$candidate->groups;
			array_push($candidates, $candidate);
		}
		return $candidates;

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

	public function getData()
	{
		$data =  [
			'quantity'      => '1' ,
			'description'   => 'some ramdom text',
			'price'   => '500',
			'total'     => '500'
		];
		return $data;
	}

	function getPdf($id){



		/*

		$data =  [
		'quantity'      => '1' ,
		'description'   => 'some ramdom text',
		'price'   => '500',
		'total'     => '500'
	];

	$date = date('Y-m-d');
	$invoice = "2222";
	$view =  \View::make('app.candidate', compact('data', 'date', 'invoice'))->render();
	$pdf = \App::make('dompdf.wrapper');
	$pdf->loadHTML($view);
	$pdf	->stream('download.pdf');

	//return $pdf->download('candidate');
	//return $pdf->stream('invoice');




	$pdf=PDF::loadView('app.candidate', $data)
	->save(public_path().'/my_stored_file.pdf')
	->stream('download.pdf');

	return $pdf;
	*/

}

function pdf($id){
	ob_start();
	set_time_limit(0);


	$candidate=Candidate::where("id", "=", $id)->first();
	$candidate->experiences;
	$candidate->academics;
	$candidate->experiencesWtc;
	$candidate->categoryCandidate;
	$candidate->subcategoryCandidate;
	$candidate->languages;
	$candidate->idioms;
	$candidate->economic;
	$candidate->photo;
	$candidate->groups;
	$candidate->user;


	$pdf =  \App::make('dompdf.wrapper');


	$name=uniqid().'.pdf';
	$view =  \View::make('pdf.invoice', compact('candidate'))->render();
	$pdf->loadHTML($view)
	//		->save(public_path().'/'.uniqid().'.pdf')
	->save(public_path().'/'.$name);

	return $name;

}


}
