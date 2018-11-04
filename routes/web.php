<?php

// User
Auth::routes();
Route::delete('account/{id}', 'UsersController@destroy')->middleware('is_admin')->name('account.destroy');
Route::post('account/changeType', 'UsersController@changeType')->middleware('is_admin')->name('change type');
Route::get('account/settings', 'UsersController@edit')->name('account settings');
Route::post('account/update', 'UsersController@update')->name('account update');
Route::post('theme/set', 'UsersController@update')->name('theme');

// Dashboard
Route::get('dashboard/view', 'DashboardController@view')->name('item view');
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('dashboard/all', 'DashboardController@all')->name('all');
Route::get('dashboard/recent', 'DashboardController@recent')->name('recent');
Route::get('dashboard/shared', 'DashboardController@shared')->name('shared');
Route::get('dashboard/trash', 'DashboardController@trash')->name('trash');
Route::get('dashboard/search', 'DashboardController@search')->name('search');
Route::get('dashboard/admin', 'DashboardController@admin')->middleware('is_admin')->name('admin');
Route::get('dashboard/admin/manage-users', 'DashboardController@manageUsers')->middleware('is_admin')->name('manage users');
Route::get('dashboard/admin/searchUsers', 'DashboardController@searchUsers')->middleware('is_admin')->name('search user');

// Files
Route::resource('posts', 'PostsController');
Route::get('file/shared/{id}/{share_token}', 'PostsController@show')->name('share page');
Route::get('file/shared/link', 'PostsController@shareLink');
Route::get('file/info', 'PostsController@getFileInfo');
Route::get('file/download/{id}/auth', 'PostsController@userDownload');
Route::post('file/download/{id}/{share_token}', 'PostsController@guestDownload');
Route::put('file/store', 'PostsController@store')->name('store');
Route::post('file/share', 'PostsController@update')->name('file update');
Route::post('file/trash', 'PostsController@update')->name('file trash');
Route::post('file/restore', 'PostsController@update')->name('file restore');
Route::post('file/delete', 'PostsController@destroy')->name('file delete');
Route::post('file/deleteMultiple', 'PostsController@destroyMultiple')->name('file delete multiple');

// Pages
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/terms', 'PagesController@terms')->name('tos');
Route::get('/privacy', 'PagesController@privacy')->name('privacy');
Route::get('/', 'PagesController@index')->name('home');
