<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/Listbook', 'GuestController@index');
Route::get('/home', 'HomeController@index');
Route::post('updatescrop', 'ImageController@updatescrop');
Route::match(['put', 'patch'], '/image/updatecrop/{id}','ImageController@updatecrop');
Route::get('/listtinymce', 'ImageController@listtinymce');
Route::get('searchlisttinymce/{title}', 'ImageController@searchlisttinymce');
Route::get('/viewlist', 'ImageController@viewlist');
Route::get('searchviewlist/{title}', 'ImageController@searchviewlist');
Route::get('/createcrop', 'ImageController@createcrop');
Route::get('/createcroppopup', 'ImageController@createcroppopup');
Route::post('storecrop', 'ImageController@storecrop');
Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'role:admin']], function () {
Route::resource('authors', 'AuthorsController');
Route::resource('books', 'BooksController');
Route::resource('user', 'UserController');
Route::resource('provinsi', 'ProvinsiController');
Route::resource('image', 'ImageController');
Route::get('export/books', [
    'as'   => 'export.books',
    'uses' => 'BooksController@export'
  ]);
  Route::post('export/books', [
    'as'   => 'export.books.post',
    'uses' => 'BooksController@exportPost'
  ]);
});

Route::get('books/{book}/borrow', [
  'middleware' => ['auth', 'role:member'],
  'as'         => 'guest.books.borrow',
  'uses'       => 'BooksController@borrow'
]);

Route::put('books/{book}/return', [
  'middleware' => ['auth', 'role:member'],
  'as'         => 'member.books.return',
  'uses'       => 'BooksController@returnBack'
]);

