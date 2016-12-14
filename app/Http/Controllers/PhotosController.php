<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;

class PhotosController extends Controller
{
  public function index(){

  }

  public function create(Request $request){

    //$data = 'data:image/png; base64,AAAFBfj42Pj4';

    list($type, $imageData) = explode(';', $request->profile);
    list(,$extension) = explode('/',$type);
    list(,$imageData) = explode(',', $imageData);
    $fileName = "images/".uniqid().'.'.$extension;

    $source = fopen($request->profile, 'r');

    $destination = fopen($fileName, 'w');
    stream_copy_to_stream($source, $destination);
    fclose($source);
    fclose($destination);


    $photo = Photo::firstOrNew(array('candidate_id' => $request->candidate));

    //$photo=Photo::where("candidate_id", "=", $request->candidate)->first();
    $photo->name_photo=$fileName;

    if($photo->save()){
      return $photo;
    }
  }
}
