<?php

Route::get('/', 'MainController@home');

Route::get('/task/{subject}', 'MainController@subject');

Route::get('/task/{subject}/{id}', 'MainController@task');

Route::get('/review', 'MainController@review')->name('review');

Route::post('/review/check', 'MainController@review_check')->name('contact');

Route::get('/user/{id}/{name}', function ($id, $name) {
    return 'ID: ' . $id . '. Name: ' . $name;
});