<?php

Route::group(['prefix' => 'accounting', 'namespace' => 'modules\Accounting\Http\Controllers'], function()
{
	Route::get('/', 'TransactionController@index');
	Route::get('categories/{type}', ['as' => 'categories.type', 'uses' => 'CategoryController@getCategories']);

	Route::resource('category', 'CategoryController');
	Route::resource('account', 'AccountController');
	Route::resource('transaction', 'TransactionController');
});

