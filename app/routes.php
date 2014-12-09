<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

Route::get('home/autocomplete', 'HomeController@autocompleteCountry');

Route::get('home/autocompletecity', 'HomeController@autocompleteCity');
Route::get('home/autocompleteairport', 'HomeController@autocompleteAirport');



Route::post('home/postcomplete', array (
		'as' => 'postcomplete',
		'uses' => 'HomeController@postFlights'
));
