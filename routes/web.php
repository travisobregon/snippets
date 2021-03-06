<?php

Route::get('/', 'SnippetsController@index')->name('home');
Route::get('/snippets/create', 'SnippetsController@create');
Route::get('/snippets/{snippet}', 'SnippetsController@show');
Route::post('/snippets', 'SnippetsController@store');
Route::get('/snippets/{snippet}/fork', 'SnippetsController@create');

Route::get('/@{user}', 'UsersController@show');

Route::post('/votes/{snippet}', 'VotesController@store');

Route::get('/top-users', 'TopUsersController@index');

Auth::routes();
