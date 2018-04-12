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