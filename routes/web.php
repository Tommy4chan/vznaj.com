<?php

Route::get('/', 'MainController@home')->name('home');

Route::get('/task/{subject}', 'MainController@subject');

Route::get('/task/{subject}/{id}', 'MainController@task')->name('task');

Route::get('/review', 'MainController@review')->name('review');

Route::get('/profile/{id}', 'MainController@profile');

Route::post('/review/check', 'MainController@review_check')->name('contact');

Route::post('/task/comment', 'MainController@comment')->name('comment');

Route::post('/task/answear', 'MainController@answear')->name('answear');

Route::get('/user/{id}/{name}', function ($id, $name) {
    return 'ID: ' . $id . '. Name: ' . $name;
});

Auth::routes();

