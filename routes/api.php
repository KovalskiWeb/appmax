<?php

Route::post('/adicionar-produtos', 'Api\ProductApiController@create');
Route::put('/baixar-produtos', 'Api\ProductApiController@update');
Route::get('/produtos', 'Api\ProductApiController@index');
