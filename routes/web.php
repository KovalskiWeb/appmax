<?php

// use App\Models\User;

// Route::get('testeagora', function () {
//     $user = User::first();

//     $token = $user->createToken('token-teste');

//     dd($token->plainTextToken);
// });

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('/admin/teste', function() {
    return storage_path();
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    /** Formulário de Login */
    Route::get('/', 'AuthController@showLoginForm')->name('login');
    Route::post('login', 'AuthController@login')->name('login.do');

    Route::group(['middleware' => ['auth']], function () {

        /** Dashboard Home */
        Route::get('home', 'AuthController@home')->name('home');

        /** Dashboard Administração -> Produtos */
        Route::any('products/search', 'ProductController@search')->name('products.search');
        Route::resource('products', 'ProductController');

    });

    /** Logout */
    Route::get('logout', 'AuthController@logout')->name('logout');

});




