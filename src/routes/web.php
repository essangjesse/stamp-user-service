<?php

use Illuminate\Http\Request;

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

$router->get('/health', function() {
    return response()->json([
      'status' => true,
      'message' => 'Welcome to Stamp!'
    ], 200);
});

$router->group([
  'prefix' => 'api',
], function() use ($router) {
  /* Version 1 */
  $router->group([
    'prefix' => 'v1'
  ], function() use ($router) {
    $router->group([
      'prefix' => 'user',
    ], function() use ($router) {
      $router->get('/', 'Apis\v1\UsersController@fetch');
      $router->put('/{id}', 'Apis\v1\UsersController@update');
      $router->post('/', 'Apis\v1\UsersController@store');
      $router->delete('/{id}', 'Apis\v1\UsersController@destroy');
      $router->post('/authenticate', 'Apis\v1\AccessTokensController@authenticate');

      $router->group([
        'prefix' => 'token'
      ], function() use ($router) {
        $router->group([
          'middleware' => 'auth:api'
        ], function() use ($router) {
          $router->get('/validate', 'Apis\v1\UsersController@fetchUserInstance');
        });
        $router->post('/revoke', 'Apis\v1\AccessTokensController@revokeToken');
        $router->post('/refresh', 'Apis\v1\AccessTokensController@refreshToken');
      });

      $router->group([
        'prefix' => 'location'
      ], function() use ($router) {
        $router->put('/{id}', 'Apis\v1\LocationController@updateLocation');
      });

      $router->group([
        'prefix' => 'password'
      ], function() use ($router) {
        $router->post('/email', 'Apis\v1\PasswordController@sendPasswordResetEmail');
        $router->post('/reset', 'Apis\v1\PasswordController@resetPassword');
      });
    });
  });
  /* Version 1 */
});
