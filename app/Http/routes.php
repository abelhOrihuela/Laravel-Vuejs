<?php

Route::get('/', function () {
  return view('app.index');
});



/* NAMESPACE FOR ACCESS MODE API */
Route::group(['prefix' => 'api'], function () {

  /* RETURN SESSION ADMIN */
  Route::post('user', [
    'uses' => 'AuthController@index',
    'as'   => 'user_store_path',
  ]);

  /* RETURN SESSION ADMIN */
  Route::post('admin/login', [
    'uses' => 'UsersController@store',
    'as'   => 'user_store_path',
  ]);

  Route::post('customer/login', [
    'uses' => 'CustomersController@store',
    'as'   => 'user_store_path',
  ]);

  Route::delete('logout', [
    'uses' => 'AuthController@destroy',
    'as'   => 'auth_destroy_path'
  ]);

  /* RETURN ALL ADMINS */
  Route::get('admins', [
    'uses' => 'UsersController@index',
    'as'   => 'admins_index_path',
  ]);

  /* RETURN CANDIDATES FOR  ADMIN */
  Route::get('admin/candidates/{id}', [
    'uses' => 'UsersController@candidates',
    'as'   => 'user_candidates_path',
  ]);

  /* RETURN ALL CANDIDATES */
  Route::get('candidates', [
    'uses' => 'CandidatesController@index',
    'as'   => 'candidates_index_path',
  ]);


  /* RETURN ALL CANDIDATES */
  Route::post('candidates/search', [
    'uses' => 'CandidatesController@search',
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
  /* UPDATE OR CREATE PHOTO FOR CANDIDATE */
  Route::post('image/profile',[
    'uses' => 'PhotosController@create',
    'as'   => 'photo_create_path'
  ]);
  /* GET PDF FOR CANDIDATE */
  Route::get('pdf/{id}',[
    'uses' => 'CandidatesController@getPdf',
    'as'   => 'photo_create_path']
  );

  /* CREATE NEW EXPERIENCE FOR CANDIDATE */
  Route::get('experience/{id}',[
    'uses' => 'CandidateExperiencesController@index',
    'as'   => 'experience_index_path'
  ]);

  /* CREATE NEW EXPERIENCE FOR CANDIDATE */
  Route::post('experience/new',[
    'uses' => 'CandidateExperiencesController@create',
    'as'   => 'experience_create_path'
  ]);
  /* EDIT EXPERIENCE CANDIDATE */
  Route::put('experience/edit',[
    'uses' => 'CandidateExperiencesController@update',
    'as'   => 'experience_update_path'
  ]);

  /* DELETE EXPERIENCE FOR CANDIDATE */
  Route::delete('experience/delete/{id}',[
    'uses' => 'CandidateExperiencesController@destroy',
    'as'   => 'experience_destroy_path']
  );

  /* CREATE NEW ACADEMIC FOR CANDIDATE */
  Route::get('academic/{id}',[
    'uses' => 'CandidateAcademicsController@index',
    'as'   => 'academic_index_path'
  ]);

  /* CREATE NEW ACADEMIC FOR CANDIDATE */
  Route::post('academic/new',[
    'uses' => 'CandidateAcademicsController@create',
    'as'   => 'academic_create_path'
  ]);

  /* EDIT ACADEMIC FOR CANDIDATE */
  Route::put('academic/edit',[
    'uses' => 'CandidateAcademicsController@update',
    'as'   => 'academic_create_path'
  ]);

  /* DELETE ACADEMIC FOR CANDIDATE */
  Route::delete('academic/delete/{id}',[
    'uses' => 'CandidateAcademicsController@destroy',
    'as'   => 'experience_destroy_path']
  );


  /* CREATE NEW EXPERIENCE FOR CANDIDATE */
  Route::get('experiencewtc/{id}',[
    'uses' => 'CandidateWtcExperienceController@index',
    'as'   => 'experiencewtc_create_path'
  ]);


  /* CREATE NEW EXPERIENCEWTC FOR CANDIDATE */
  Route::post('experiencewtc/new',[
    'uses' => 'CandidateWtcExperienceController@create',
    'as'   => 'experiencewtc_create_path'
  ]);

  /* DELETE EXPERIENCEWTC FOR CANDIDATE */
  Route::delete('experiencewtc/delete/{id}',[
    'uses' => 'CandidateWtcExperienceController@destroy',
    'as'   => 'experience_destroy_path']
  );

  /* EDIT EXPERIENCEWTC FOR CANDIDATE */
  Route::put('experiencewtc/edit',[
    'uses' => 'CandidateWtcExperienceController@update',
    'as'   => 'experiencewtc_update_path'
  ]);

  /* DELETE EXPERIENCE FOR CANDIDATE */
  Route::get('economic/{id}',[
    'uses' => 'CandidateEconomicController@index',
    'as'   => 'economic_index_path'
  ]);

  /* DELETE EXPERIENCE FOR CANDIDATE */
  Route::post('economic/new',[
    'uses' => 'CandidateEconomicController@create',
    'as'   => 'economic_create_path'
  ]);

  /* DELETE EXPERIENCE FOR CANDIDATE */
  Route::put('economic/edit',[
    'uses' => 'CandidateEconomicController@update',
    'as'   => 'experience_update_path'
  ]);

  Route::get('groups',[
    'uses' => 'GroupsController@index',
    'as'   => 'groups_index_path'
  ]);

  /* DELETE EXPERIENCE FOR CANDIDATE */
  Route::post('group/new',[
    'uses' => 'GroupsController@create',
    'as'   => 'group_create_path'
  ]);

  Route::get('group/candidates/{id}',[
    'uses' => 'GroupsController@show',
    'as'   => 'groups_show_path'
  ]);

  Route::delete('language/delete/{id}',[
    'uses' => 'LanguagesController@destroy',
    'as'   => 'Language_destroy_path'
  ]);

  Route::post('language/new',[
    'uses' => 'LanguagesController@create',
    'as'   => 'Language_create_path'
  ]);

  Route::delete('idiom/delete/{id}',[
    'uses' => 'IdiomsController@destroy',
    'as'   => 'Language_destroy_path'
  ]);

  Route::post('idiom/new',[
    'uses' => 'IdiomsController@create',
    'as'   => 'Language_create_path'
  ]);

  Route::get('customers',[
    'uses' => 'CustomersController@index',
    'as'   => 'customers_index_path'
  ]);

  Route::post('customer/new',[
    'uses' => 'CustomersController@create',
    'as'   => 'customers_create_path'
  ]);


});
