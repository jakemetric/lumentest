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

$app->get('/', function () use ($app) {
//    return env('APP_KEY');
//    exit;
    return $app->welcome();
});

$app->group(['middleware' => 'bot', 'namespace' => 'App\Http\Controllers'], function($app) {
    $app->get('testapi', 'ApiTest@index');
});

//$app->get('testapi', 'ApiTest@index');