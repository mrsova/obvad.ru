<?php

Route::group(['prefix'=>'admin', 'namespace'=>'Admin','middleware' => 'admin'], function(){
    Route::get('/', 'DashboardController@index');
    Route::resource('/users', 'UsersController');
    Route::resource('/posts', 'PostsController');
    Route::get('/posts/toggle/{id}', 'PostsController@toggle');
    Route::resource('/meta', 'MetaController');

    /*Route::resource('/categories', 'CategoriesController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/users', 'UsersController');
    Route::resource('/posts', 'PostsController');
    Route::get('/comments', 'CommentsController@index')->name('comments.index');
    Route::delete('/comments/{id}/destroy', 'CommentsController@destroy')->name('comments..destroy');
    Route::resource('/subscribers', 'SubsController');*/
});


Route::group(['namespace'=>'Front'], function(){
    Route::get('/', 'PostsController@index');
    Route::get('/vklogin', 'AuthController@vkLogin')->name('vklogin');
    Route::get('/auth/callback', 'AuthController@AuthVk');
    Route::post('/setviews', 'PostsController@setViews');
    Route::get('/info', 'InfoController@Index');

    //Если пользователь авторизован то разрешаем маршрут
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/logout', 'AuthController@logout');
        Route::get('/profile', 'ProfileController@index');
        Route::post('/profile', 'ProfileController@store');
        Route::post('/addpost', 'PostsController@addPost');
    });

    //Если не авторизован то разрешаем такие маршруты вся фишка в middleware class RedirectIfAutentificated
    Route::group(['middleware' => 'guest'], function() {
        Route::get('/login', 'AuthController@loginForm')->name('login');
        Route::post('/login', 'AuthController@login');
        Route::get('/register', 'AuthController@registerForm');
        Route::post('/register', 'AuthController@register');
        Route::get('/resetpass', 'AuthController@resetPassShowForm')->name('resetpass');
        Route::post('/resetpass', 'AuthController@resetPass');
        Route::get('/resetpass/{token}', 'AuthController@showSaveNewPasswordForm');
        Route::post('/resetpass/{token}', 'AuthController@resetPassNew');
    });
});