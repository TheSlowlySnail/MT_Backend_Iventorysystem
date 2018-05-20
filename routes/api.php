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
    'uses' => 'InventarController@postItem'
]);

Route::get('/items',[
    'uses' => 'InventarController@getItems'
]);

//Update Command
Route::put('/item/{barcode}', [
    'uses' => 'InventarController@putItem'
]);

Route::delete('/item/{barcode}', [
        'uses' => 'InventarController@deleteItem'
    ]
);

//User
//Route::post('/person', [
//    'uses' => 'PersonsController@postPerson'
//]);

Route::get('/users',[
    'uses' => 'UserController@userDetails'
]);

//Update Command
Route::put('/user/{id}', [
    'uses' => 'UserController@putUser'
]);

Route::delete('/user/{id}', [
        'uses' => 'UserController@deletePerson'
    ]
);

//Lendings
Route::post('/lend', [
    'uses' => 'LendingController@postLend'
]);

Route::get('/lends',[
    'uses' => 'LendingController@getLends'
]);

//Update Command
Route::put('/lend/{id}', [
    'uses' => 'LendingController@putLend'
]);

Route::delete('/lend/{id}', [
        'uses' => 'LendingController@deleteLend'
    ]
);

//Store Image

Route::post('/store', [
    'uses' => 'uploadController@store'
]);

Route::post('userLogin', 'UserController@userLogin');
Route::post('userRegister', 'UserController@userRegister');
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('userDetails', 'UserController@userDetails');
});