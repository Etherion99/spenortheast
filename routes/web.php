<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\RoutingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'RoutingController@home');

Route::get('/acceso', function () {
    return view('access');
});

Route::get('/nosotros', 'RoutingController@about');
Route::get('/eventos/{id?}', 'RoutingController@events');
Route::get('/programas/{id?}', 'RoutingController@programs');
Route::get('/capitulos/{id?}', 'RoutingController@chapters');
Route::get('/membresias', 'RoutingController@memberships');
Route::get('/contacto', 'RoutingController@contact');

Route::post('/images_upload', 'ImagesController@upload');

Route::post('/member/create', 'MembersController@create');
Route::post('/member/edit', 'MembersController@edit');
Route::post('/member/remove', 'MembersController@remove');

Route::post('/event/create', 'EventsController@create');
Route::post('/event/edit', 'EventsController@edit');
Route::post('/event/remove', 'EventsController@remove');

Route::get('/event/description/{id}', ['uses' => 'EventsController@description']);

Route::post('/chapter/create', 'ChaptersController@create');
Route::post('/chapter/edit', 'ChaptersController@edit');
Route::post('/chapter/remove', 'ChaptersController@remove');

Route::get('/chapter/description/{id}', ['uses' => 'ChaptersController@description']);

Route::post('/program/create', 'ProgramsController@create');
Route::post('/program/edit', 'ProgramsController@edit');
Route::post('/program/remove', 'ProgramsController@remove');

Route::get('/program/description/{id}', ['uses' => 'ProgramsController@description']);

Route::post('/message/send', 'MessagesController@send');

Auth::routes(['register' => false]);


Route::get('/save_indicators', ['uses' => 'APIController@saveIndicators']); //actualizar indicadores economicos

Route::get('/IG', ['uses' => 'APIController@getIGFeed']); //borrar luego
Route::get('/IND', ['uses' => 'RoutingController@getIndicators']); //borrar luego

