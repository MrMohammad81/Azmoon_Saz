<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'api/v1'] , function () use ($router)
{
    $router->group(['prefix' => 'users'] , function () use ($router)
    {
        $router->post('' , ['uses' => 'API\V1\Users\UsersController@store']);
        $router->put('' , ['uses' => 'API\V1\Users\UsersController@updateInfo']);
        $router->put('change-password' , ['uses' => 'API\V1\Users\UsersController@updatePassword']);
        $router->delete('' , ['uses' => 'API\V1\Users\UsersController@deleteUser']);
        $router->get('' , ['uses' => 'API\V1\Users\UsersController@index']);
    });
});
