<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return view("welcome");
});



//hantering av färger på webbsidan
$router->get('/farger', 'ColorController@show');
$router->get('/farger/{back}[/{front}]', 'ColorController@withParams');
$router->post('/farger', 'ColorController@post');

//todo
$router->get('/todo', 'ToDoController@show');
$router->post('/todo', 'ToDoController@add');
$router->delete('/todo', 'ToDoController@remove');
$router->put('/todo', 'ToDoController@update');

//användare
$router->group(['middleware'=>'auth.user'], function() use ($router) {

  $router->get('/anvandare', 'UserController@show');
  $router->get('/anvandare/{id}', 'UserController@showUser');
  $router->post('/anvandare/{id}', 'UserController@modifyUser');
  $router->post('/anvandare', 'UserController@add');
});

//inloggning
$router->get('/login', 'LoginController@show');
$router->post('/login', 'LoginController@login');


$router->get('/{id}', function ($id) use ($router) {
  $reserverad=['todo', 'farger'];
  if (in_array(strtolower($id), $reserverad)) {
    return redirect('/' . strtolower($id));
  }
  return view("hello", ['namn'=>$id]);
});