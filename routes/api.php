<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/item', [
    'uses' => 'QuoteController@postItem'
]);

Route::get('/items',[
    'uses' => 'QuoteController@getItems'
]);

//Update Command
Route::put('/item/{barcode}', [
    'uses' => 'QuoteController@putItem'
]);

Route::delete('/item/{barcode}', [
        'uses' => 'QuoteController@deleteItem'
    ]
);

//Persons
Route::post('/person', [
    'uses' => 'QuoteController@postPerson'
]);

Route::get('/persons',[
    'uses' => 'QuoteController@getPersons'
]);

//Update Command
Route::put('/item/{personid}', [
    'uses' => 'QuoteController@putPerson'
]);

Route::delete('/item/{personid}', [
        'uses' => 'QuoteController@deletePerson'
    ]
);

//Lendings
Route::post('/lend', [
    'uses' => 'QuoteController@postLend'
]);

Route::get('/lends',[
    'uses' => 'QuoteController@getLends'
]);

//Update Command
Route::put('/lend/{id}', [
    'uses' => 'QuoteController@putLend'
]);

Route::delete('/lend/{id}', [
        'uses' => 'QuoteController@deleteLend'
    ]
);