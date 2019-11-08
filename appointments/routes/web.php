<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1'], function() use ($router) {
    $router->get('/appointments', [
        'as' => 'appointments.index',
        'uses' => 'AppointmentsController@index'
    ]);
    
    $router->get('/appointments/{id}/', [
        'as' => 'appointments.show',
        'uses' => 'AppointmentsController@show'
    ]);
    
    $router->post('/appointments', [
        'as' => 'appointments.store',
        'uses' => 'AppointmentsController@store'
    ]);

    $router->delete('/appointments/{id}', [
        'as' => 'appointments.delete',
        'uses' => 'appointments@destroy'
    ]);
});
