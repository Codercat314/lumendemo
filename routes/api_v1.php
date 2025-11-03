<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/ping', function(){
    return response()->json(['pong'=>true]);
});




//användare



//login och refresh

$router->post('/login','AuthenticationController@login');
$router->get('/refresh','AuthenticationController@refresh');
$router->delete('/refresh','AuthenticationController@logout');


$router->group(['middleware' => 'api.auth'], function () use ($router){

    $router->get('/todo/{id}','TodoApiController@get');
$router->post('/todo','TodoApiController@add');
$router->put('/todo/{id}','TodoApiController@update');
$router->delete('/todo','TodoApiController@remove');
$router->get('/todo','TodoApiController@all');
$router->patch('/todo/{id}','TodoApiController@check');

$router->post('/anvandare','UserApiController@add');
$router->get('/anvandare/{id}','UserApiController@get');
$router->put('/anvandare/{id}','UserApiController@update');
$router->delete('/anvandare','UserApiController@remove');
$router->get('/anvandare','UserApiController@all');
});