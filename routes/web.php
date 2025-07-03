<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Route;

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

$router->get('/', function () {
    return view('dashboard');
    // return $router->app->version();
});

// Preblock routes
Route::get('/preblock', 'PreblockMclController@index');
$router->get('/preblock-visit', 'PreblockMclController@showVisit');
$router->get('/crm-details', 'PreblockMclController@getAllCrmDetails');
$router->get('/generate-transno', 'PreblockMclController@generateTransNo');
$router->post('/store', 'PreblockMclController@store');
$router->post('/update', 'PreblockMclController@update');
$router->delete('/destroy/{id}', 'PreblockMclController@destroy');
$router->get('/crm-visits', 'PreblockMclController@getVisits');
$router->post('/crm-visit-detail/{id}/is-visited', 'PreblockMclController@updateIsVisited');
$router->post('/crm-visits/export-pdf', 'PreblockMclController@exportPdf');

Route::get('/report-customer', 'ReportSalesDistrictController@index');
Route::post('/report-customer-export', 'ReportSalesDistrictController@exportByCustomer');

$router->group(['prefix' => 'auth'], function ($router) {
    $router->post('login', 'AuthController@login'); // No middleware here!
    $router->post('logout', ['middleware' => 'auth:api', 'uses' => 'AuthController@logout']);
    $router->post('refresh', ['middleware' => 'auth:api', 'uses' => 'AuthController@refresh']);
    $router->get('me', ['middleware' => 'auth:api', 'uses' => 'AuthController@me']);
});
