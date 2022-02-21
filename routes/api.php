<?php

// Cria um token do usuário que esteja cadastrado na tabela User
Route::post('/registrar/token', 'Api\Auth\AuthApiController@auth');

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/produtos', 'Api\ProductApiController@index');
    Route::get('/auth/me', 'Api\Auth\AuthApiController@me');
});

Route::post('/adicionar-produtos', 'Api\ProductApiController@create');
Route::put('/baixar-produtos', 'Api\ProductApiController@update');

