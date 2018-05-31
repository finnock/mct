<?php

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

use App\Card;

Auth::routes();


Route::get('/test', function () {
    return view('test');
});

Route::prefix('api')->middleware(['api', 'auth'])->group(function () {
    Route::get('collection', 'APIController@indexCollection')->name('api.collection.index');
    Route::get('sets/{code}', 'APIController@showSet')->name('api.set.show');
    Route::get('formats/arena', 'APIController@formatArena')->name('api.format.arena');
});

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('/standard', function () {
        $cards = Card::cardListToVueModel(Auth::user()->cards()->orderBy('created_at', 'desc')->get());
        $count = true;

        return view('user.collection')->with(compact('cards', 'count'));
    });

    Route::get('/collection', 'CollectionController@index')->name('collection.index');
    Route::get('/collection/add', 'CollectionController@add')->name('collection.add');
    Route::get('/collection/add-batch', 'CollectionController@addBatch')->name('collection.add-batch');
    Route::post('/collection', 'CollectionController@store');
    Route::patch('/collection/{id}', 'CollectionController@update');
    Route::delete('/collection/{id}', 'CollectionController@delete');

    Route::get('/sets/{code}/{number}/image', 'CardController@image')->name('card.image');
    Route::get('/sets/{code}/{number}/image/landscape', 'CardController@imageLandscape')->name('card.image-landscape');
    Route::get('/sets/{code}/{number}', 'CardController@show')->name('showCard');

    Route::get('/sets/{code}', 'SetController@show');
    Route::get('/sets', 'SetController@index');
    Route::get('/formats/arena', 'SetController@formatArena')->name('format.arena');

    Route::get('/', 'CollectionController@dashboard')->name('dashboard');

    Route::get('/{url}', function () {
        return redirect('/');
    });
});