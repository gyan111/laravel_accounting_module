<?php


Route::get('language/{lang}', 'LanguageController@setLanguage');



Route::group(['prefix' => 'accounting', 'namespace' => 'Modules\Accounting\Http\Controllers'], function()
{
	Route::get('categories/{type}', ['as' => 'categories.type', 'uses' => 'CategoryController@getCategories']);

	Route::get('/', 'AccountingController@index');
	// Route::get('categories/{type}', ['as' => 'categories.type', 'uses' => 'CategoryController@getCategories']);
	// Route::get('accounts/{type}', ['as' => 'accounts.type', 'uses' => 'AccountController@getCategories']);

	Route::resource('category', 'CategoryController');
	Route::resource('account', 'AccountController');
	Route::resource('transaction', 'TransactionController');
	Route::resource('user', 'UserController');
});

