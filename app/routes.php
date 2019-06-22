<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

// Routes

$app->get('/', 'HomeAction:index')->setName('home');

$app->group('/adminlogin', function() use ($app){

    $this->get('/', 'AdminAction:loginPage')->setName('login');

    $this->post('/', 'AdminAction:loginPost')->setName('loginPost');

});




$app->group('/admin', function() use ($container){

    $this->get('/home', 'AdminAction:home')->setName('adminHome');
    $this->get('/upload','AdminAction:getUpload')->setName('adminUpload');
    $this->post('/upload','AdminAction:uploadToDBAndApi')->setName('uploadToApi');
})->add(new \App\Middlewares\AuthenticationMiddleware($container));

