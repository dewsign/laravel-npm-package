<?php

namespace Maxfactor\CMS\Pages;

use Illuminate\Support\Facades\Route;

class Routes
{
    public static function admin()
    {
        // Pages
        return Route::group(['prefix' => 'page', 'as' => 'page.', 'auth' => 'can:access_admin_pages'], function () {
            Route::get('/', 'PageController@index')->name('index');
            Route::get('create', 'PageController@create')->name('create');
            Route::post('create', 'PageController@store')->name('store');
            Route::post('{page}', 'PageController@update')->name('update');
            Route::delete('{page}', 'PageController@destroy')->name('destroy');
        });
    }

    public static function web()
    {
        //
    }
}
