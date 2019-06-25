<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

// Routes

$app->get('/', 'VisitorAction:index')->setName('home');

$app->get('/gallery','VisitorAction:getGallery')->setName('gallery');

$app->get('/images_json','VisitorAction:getImagesJson')->setName('getImages_Json');

$app->get('/images_json/{offset}', 'VisitorAction:getImagesJsonOffset')->setName('getImages_Json_Offset');


$app->group('/adminlogin', function() use ($app){

    $this->get('/', 'AdminAction:loginPage')->setName('login');

    $this->post('/', 'AdminAction:loginPost')->setName('loginPost');

});




$app->group('/admin', function() use ($container){

    $this->get('/home', 'AdminAction:home')->setName('adminHome');
    $this->get('/upload','AdminAction:getUpload')->setName('adminUpload');
    $this->post('/upload','AdminAction:uploadToDBAndApi')->setName('uploadToApi');
})->add(new \App\Middlewares\AuthenticationMiddleware($container));

