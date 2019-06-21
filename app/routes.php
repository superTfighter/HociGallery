<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

// Routes

$app->get('/', function ($request, $response, $args) {
    return $response->withRedirect($this->router->pathFor('home'));
});


$app->get('/home', 'HomeAction:index')->setName('home');


$app->group('/admin', function() use ($app){

    $this->get('/login', 'AdminAction:loginPage');


});

