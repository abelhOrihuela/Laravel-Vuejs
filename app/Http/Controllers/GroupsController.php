<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Group;
use Session;

class GroupsController extends Controller
{
  public function index(){


    if(Session::get('profile')=='C'){
      $groups=Group::where('visible', "=",0)->get();
    }else{
      $groups=Group::all();
    }

    foreach ($groups as $group) {
      $group->categoryGroup;
      $group->subcategoryGroup;
    }
    return $groups;
  }

  public function show($id){
    $group=Group::where('id',  $id)->first();
    $group->candidates;

    foreach ($group->candidates as $candidate) {
      $candidate->categoryCandidate;
      $candidate->subcategoryCandidate;
      $candidate->languages;
      $candidate->idioms;
      $candidate->photo;
      $candidate->groups;
    }
    return $group;
  }

  public function create(Request $request){

    $group = new Group();
    $group->user_id= Session::get('user_id');

    if($request->name_group){
      $group->name_group=$request->name_group;
    }
    if($request->category){
      $group->category=$request->category;
    }
    if($request->subcategory){
      $group->subcategory=$request->subcategory;
    }
    if($request->visible){
      $group->visible=$request->visible;
    }

    if($group->save()){
      $group->categoryGroup;
      $group->subcategoryGroup;

      return  $group;
    }else{
      abort(404);
    }
  }

  public function update(Request $request){

    $input = $request->all();
    $group=Group::where('id',  $request->id);

    if($group->update($input)){
      $group=Group::where('id',  $request->id)->first();
      $group->categoryGroup;
      $group->subcategoryGroup;

      return $group;

    }else{
      abort(404);
    }
  }

  public function destroy($id){

    $group = Group::where("id", "=", $id)->first();

    $group->candidates()->detach();


    if($group->forceDelete()){
      return response()->json([
        'status' => 200
      ]);
    }else{
      abort(403, 'Unauthorized action.');
    }

  }

  public function candidate_group(Request $request){
    $group=Group::where('id',  $request->id)->first();
    $exist=$group->candidates->contains( $request->candidate_id);

    if($exist){
      abort(403, 'Unauthorized action.');
    }else{
      $group->candidates()->attach($request->candidate_id);

      return $group;
    }
  }
  public function delete_candidate($group, $id){

    $group=Group::where('id',  $group)->first();
    $exist=$group->candidates->contains($id);

    if($exist){
      $group->candidates()->detach($id);
    }
  }
}
