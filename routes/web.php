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
Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@home');
Route::get('/logout', 'HomeController@logout');

Route::group([], function(){
    Route::resource('clientes','ClientesController');
    Route::get('clientes/{id}/destroy',[
    	'uses' => 'ClientesController@destroy',
    	'as' => 'clientes.destroy'
    	]);
    });

Route::group([], function(){
    Route::resource('productos','ProductosController');
    Route::get('productos/{id}/destroy',[
        'uses' => 'ProductosController@destroy',
        'as' => 'productos.destroy'
        ]);
    });

    Route::group([], function(){
    Route::resource('inventarios','InventariosController');
    Route::get('inventarios/{id}/destroy',[
        'uses' => 'InventariosController@destroy',
        'as' => 'inventarios.destroy'
        ]);
    });

Route::group([], function(){
    Route::resource('ventas','VentasController');
    Route::get('ventas/{id}/destroy',[
        'uses' => 'VentasController@destroy',
        'as' => 'ventas.destroy'
        ]);
    Route::post('ventas/prestore',[
        'uses' => 'VentasController@prestore',
        'as' => 'ventas.prestore'
        ]);
    Route::get('ventas/{id}/view',[
        'uses' => 'VentasController@view',
        'as' => 'ventas.view'
        ]);
    Route::get('ventas/{id}/pdf',[
        'uses' => 'VentasController@pdf',
        'as' => 'ventas.pdf'
        ]);
    Route::get('ventas/{id}/update',[
        'uses' => 'VentasController@update',
        'as' => 'ventas.update'
        ]);
    });
