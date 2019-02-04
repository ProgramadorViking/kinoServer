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

//Login --> crea el token
$router->post('/auth/login','AuthController@postLogin');

//Rutas con token
$router->group(['middleware'=>'auth:api'],function($router){
    //Grupo usuarios + editors + admin
    $router->group(['middleware'=>'role:user'],function($router){
        $router->get('films', 'FilmsController@all');
        $router->get('films/{id}', 'FilmsController@get');
    });
    //Grupo editores + admin
    $router->group(['middleware'=>'role:editor'],function($router){
        $router->post('films', 'FilmsController@add');
        $router->put('films/{id}', 'FilmsController@put');
    });
    //Grupo administradores
    $router->group(['middleware'=>'role:admin'],function($router){
        
    });
    $router->get('/test',function(){
        return response()->json([
            'message'=>'Hello World!',
        ]);
    });
});


$router->delete('films/{id}', 'FilmsController@remove');
