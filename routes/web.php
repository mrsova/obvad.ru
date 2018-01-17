<?php

Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function(){
    Route::get('/', 'DashboardController@index');
    Route::resource('/users', 'UsersController');
    //Route::resource('/posts', 'PostsController');
    /*Route::resource('/categories', 'CategoriesController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/users', 'UsersController');
    Route::resource('/posts', 'PostsController');
    Route::get('/comments', 'CommentsController@index')->name('comments.index');
    Route::delete('/comments/{id}/destroy', 'CommentsController@destroy')->name('comments.destroy');
    Route::get('/comments/toggle/{id}', 'CommentsController@toggle');
    Route::get('/comments/toggle/{id}', 'CommentsController@toggle');
    Route::resource('/subscribers', 'SubsController');*/
});


Route::group(['namespace'=>'Front'], function(){
    Route::get('/', 'HomeController@index');
    Route::get('/vklogin', 'AuthController@vkLogin')->name('vklogin');
    Route::get('/auth/callback', 'AuthController@AuthVk');

        Route::get('/login', 'AuthController@loginForm')->name('login');
        Route::post('/login', 'AuthController@login');


    Route::get('/logout', 'AuthController@logout');
});