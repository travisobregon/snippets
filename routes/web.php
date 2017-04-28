<?php

Route::get('ci', function () {
    dump('we made it!');
    dd(env('APP_ENV'));
});

Route::get('/', 'SnippetsController@index')->name('home');
Route::get('/snippets/create', 'SnippetsController@create');
Route::get('/snippets/{snippet}', 'SnippetsController@show');
Route::post('/snippets', 'SnippetsController@store');
Route::get('/snippets/{snippet}/fork', 'SnippetsController@create');

Route::get('/@{user}', 'UsersController@show');

Route::post('/votes/{snippet}', 'VotesController@store');

Auth::routes();
