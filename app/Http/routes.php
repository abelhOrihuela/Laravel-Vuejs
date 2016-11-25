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

});
