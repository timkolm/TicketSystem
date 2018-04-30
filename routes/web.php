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

Route::get('/', function () {
    return redirect('list-tickets');
});

Route::get('list-tickets/{sortBy?}', 'TicketController@index')->name('index');
Route::get('new-ticket', 'TicketController@create')->name('create');
Route::post('submit', 'TicketController@store')->name('store');
Route::get('edit/{id}', 'TicketController@edit')->name('edit');
Route::post('update/{id}', 'TicketController@update')->name('update');
Route::get('delete/{id}', 'TicketController@destroy')->name('destroy');
Route::get('close/{id}', 'TicketController@close')->name('close');
Route::get('reopen/{id}', 'TicketController@reopen')->name('reopen');
Route::get('show/{id}', 'TicketController@show')->name('show');

Route::post('comment', 'CommentController@store')->name('commentCreate');
Route::get('removeFile/{id}', 'TicketController@removeFile')->name('removeFile');