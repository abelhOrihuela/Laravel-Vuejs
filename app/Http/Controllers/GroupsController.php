<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Group;
use Session;
use DB;

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


    $statement="SELECT
		candidates.id,
		candidates.user_id,
		candidates.username,
		candidates.url,
		candidates.gender,
		candidates.email,
		candidates.location,
		candidates.day,
		candidates.month,
		candidates.year,
		candidates.code,
		candidates.phone,
		candidates.position,
		candidates.category,
		candidates.subcategory,
		candidates.created_at,
		candidates.updated_at,
		photos.name_photo,
		category.name as name_category,
		subcategories.name as name_subactegory
		FROM photos, candidates, category, subcategories, relationgroup
		WHERE photos.candidate_id=candidates.id
		AND candidates.category=category.id
		AND candidates.subcategory=subcategories.id
        AND relationgroup.candidate_id=candidates.id
        AND relationgroup.group_id=
".$id;

        $result=DB::select(DB::raw($statement));

        return $result;
  }

  public function groups_candidate($id){
    $statement="SELECT groups.id,
	   groups.user_id,
       groups.name_group,
       groups.url,
       groups.category,
       groups.subcategory,
       groups.visible
       FROM groups , relationgroup
WHERE groups.id=relationgroup.group_id
AND relationgroup.candidate_id=".$id;

	$result=DB::select(DB::raw($statement));


  return $result;
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
