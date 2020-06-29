<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin','namespace'=>'Admin','middleware'=>'auth'], function () {

    Route::get('/','AdminController@index')->name('dashboard');
    Route::resource('posts', 'PostController',['except'=>'show','as'=>'admin']);
    Route::resource('users', 'UserController',['as'=>'admin']);
    Route::resource('roles', 'RolesController',['except'=>'show','as'=>'admin']);
    Route::resource('permissions', 'PermissionController',['only'=> ['index','edit','update'],'as'=>'admin']);
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::put('users/{user}/roles', 'UserRolesController@update')->name('admin.users.roles.update');
        Route::put('users/{user}/permission', 'UserPermissionsController@update')->name('admin.users.permisos.update');
    });
    Route::post('users/roles', 'UserRolesController@store')->name('admin.users.roles.store');
    Route::post('users/permission', 'UserPermissionsController@store')->name('admin.users.permisos.store');


    Route::post('posts/{post}/photos','PhotoController@store')->name('admin.photos.store');
    Route::delete('photos/{photo}','PhotoController@destroy')->name('admin.photos.destroy');


   });

   Auth::routes(['Except'=>'Register']);

   Route::get('/{any?}','PagesController@home')->name('page.home')->where('any','.*');
