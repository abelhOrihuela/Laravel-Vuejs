<?php

Route::get('/', function () {
  return view('app.index');
});



/* NAMESPACE FOR ACCESS MODE API */
Route::group(['prefix' => 'api'], function () {

  /* RETURN SESSION ADMIN */
  Route::post('admin/login', [
    'uses' => 'UsersController@store',
    'as'   => 'user_store_path',
  ]);


  Route::get('admins', [
    'uses' => 'UsersController@index',
    'as'   => 'admins_index_path',
  ]);

  /* RETURN SESSION ADMIN */
  Route::get('admin/candidates/{id}', [
    'uses' => 'UsersController@candidates',
    'as'   => 'user_candidates_path',
  ]);

  /* RETURN ALL CANDIDATES */
  Route::get('candidates', [
    'uses' => 'CandidatesController@index',
    'as'   => 'candidates_index_path',
  ]);

  /* RETURN ONE CANDIDATE */
  Route::get('candidate/{id}', [
    'uses' => 'CandidatesController@show',
    'as'   => 'candidate_show_path',
  ]);

  /* RETURN ALL CATEGORIES */
  Route::get('categories', [
    'uses' => 'CategoriesController@index',
    'as'   => 'categories_index_path',
  ]);

  /* RETURN SUBCATEGORIES WITH FILTER CATEGORY */
  Route::get('subcategories/{id}', [
    'uses' => 'SubCategoriesController@index',
    'as'   => 'subcategories_index_path',
  ]);

  /* CREATE NEW CANDIDATE */
  Route::post('candidate/new',[
    'uses' => 'CandidatesController@create',
    'as'   => 'candidate_create_path'
  ]);

  Route::post('image/profile',[
    'uses' => 'PhotosController@create',
    'as'   => 'photo_create_path'
  ]);

  Route::get('pdf/{id}',[
    'uses' => 'CandidatesController@getPdf',
    'as'   => 'photo_create_path']
  );


  Route::delete('experience/delete/{id}',[
    'uses' => 'CandidateExperiencesController@destroy',
    'as'   => 'experience_destroy_path']
  );


  /* CREATE NEW CANDIDATE */
  Route::post('experience/new',[
    'uses' => 'CandidateExperiencesController@create',
    'as'   => 'experience_create_path'
  ]);

  /* CREATE NEW CANDIDATE */
  Route::post('academic/edit',[
    'uses' => 'CandidateAcademicsController@update',
    'as'   => 'academic_create_path'
  ]);

  Route::post('academic/new',[
    'uses' => 'CandidateAcademicsController@create',
    'as'   => 'academic_create_path'
  ]);



  Route::delete('academic/delete/{id}',[
    'uses' => 'CandidateAcademicsController@destroy',
    'as'   => 'experience_destroy_path']
  );



});
