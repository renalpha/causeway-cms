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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'Admin\SoundController@foobar');
/**
 * Protected routes for verified users...
 */
Route::group(['middleware' => ['verified', 'auth']], function () {

    // Ajax routing
    Route::group(['prefix' => 'ajax'], function () {
        Route::get('reset/points', 'UserController@reset');
        Route::get('like/type/{type}/id/{id}', 'LikeController@like')->name('like.toggle');
        Route::post('comment/type/{type}/id/{id}', 'CommentController@comment')->name('comment.store');
        // Ajax group actions
        Route::group(['prefix' => 'group'], function () {
            Route::get('{label}/members', 'GroupController@getUsersOverviewGroup')->name('ajax.group.members');
            Route::get('index', 'GroupController@getGroupsByUser')->name('ajax.group.index');
        });

        Route::group(['prefix' => 'events', 'middleware' => ['admin']], function () {
            Route::get('index', 'EventController@getAjaxEvents')->name('ajax.events.index');
        });

        Route::group(['prefix' => 'pages', 'middleware' => ['admin']], function () {
            Route::get('index', 'PageController@getAjaxPages')->name('ajax.pages.index');
        });
    });

    Route::group(['namespace' => 'Admin', 'middleware' => 'admin', 'prefix' => 'admin'], function () {

        Route::get('/', function () {
            return redirect()
                ->route('admin.dashboard');
        });

        Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

        Route::group(['prefix' => 'photo'], function () {

            Route::group(['prefix' => 'album'], function () {
                Route::get('/new', 'PhotoAlbumController@createAlbum')->name('admin.album.create');
                Route::post('/new', 'PhotoAlbumController@storeAlbum')->name('admin.album.new.store');
                Route::get('/edit/{photoAlbum}', 'PhotoAlbumController@editAlbum')->name('admin.album.edit');
                Route::post('/edit/{photoAlbum}', 'PhotoAlbumController@storeAlbum')->name('admin.album.edit.store');
                Route::get('/remove/{photoAlbum}', 'PhotoAlbumController@removeAlbum')->name('admin.album.remove');
                Route::get('/{photoAlbum?}', 'PhotoAlbumController@index')->name('admin.album.index');
            });

            Route::get('/new', 'PhotoAlbumController@newPhoto')->name('admin.photo.create');
            Route::post('/new', 'PhotoAlbumController@storePhoto')->name('admin.photo.new.store');
            Route::get('/edit/{photo}', 'PhotoAlbumController@editPhoto')->name('admin.photo.edit');
            Route::post('/edit/{photo}', 'PhotoAlbumController@storePhoto')->name('admin.photo.new.store');
            Route::get('/remove/{photo}', 'PhotoAlbumController@removePhoto')->name('admin.photo.remove');
            Route::post('/upload', 'PhotoAlbumController@upload')->name('admin.photo.upload');
        });

        Route::resource('events', 'EventController')->names([
            'index' => 'admin.events.index',
            'create' => 'admin.events.create',
            'edit' => 'admin.events.update',
            'store' => 'admin.events.new.store',
            'update' => 'admin.events.update.store',
        ]);

        Route::resource('pages', 'PageController')->names([
            'index' => 'admin.pages.index',
            'create' => 'admin.pages.create',
            'edit' => 'admin.pages.update',
            'store' => 'admin.pages.new.store',
            'update' => 'admin.pages.update.store',
        ]);

    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'Auth\UserProfileController@show')->name('profile');
    });
});