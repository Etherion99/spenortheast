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

Route::get('/', function () {
    return view('home');
});

Route::get('/acceso', function () {
    return view('access');
});

Route::get('/nosotros', 'RoutingController@about');
Route::get('/eventos', 'RoutingController@events');
Route::get('/programas', 'RoutingController@programs');
Route::get('/capitulos_estudiantiles/{id?}', ['uses' => 'RoutingController@students_chapters']);
Route::get('/membresias', 'RoutingController@memberships');

Route::get('/contacto', function () {
    return view('contact');
});

Route::post('/images_upload', 'ImagesController@upload');

Route::post('/member/create', 'MembersController@create');
Route::post('/member/edit', 'MembersController@edit');
Route::post('/member/remove', 'MembersController@remove');

Route::post('/event/create', 'EventsController@create');
Route::post('/event/edit', 'EventsController@edit');
Route::post('/event/remove', 'EventsController@remove');

Route::get('/evento/{id}', 'EventsController@index');
Route::get('/event/description/{id}', ['uses' => 'EventsController@description']);

Route::post('/message/send', 'MessagesController@send');

Auth::routes(['register' => false]);