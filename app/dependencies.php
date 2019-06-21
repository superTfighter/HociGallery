<?php

use Slim\Views\Twig;
use PHPMailer\PHPMailer\PHPMailer;

$container = $app->getContainer();



\Cloudinary::config(array(
    'cloud_name' => 'da2z9uwck',
    'api_key' => '493711661824112',
    'api_secret' => 'x_ydLqhwe2B9QGinEbk1qRTnEUs'
));



//Twig view
$container['view'] = function($container) {

    //$settings = $container->get('settings');

    $view = new \Slim\Views\Twig(
        __DIR__ . '/Resources/templates', [
        'cache' => false 
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new Twig_Extension_Debug());


    $view->getEnvironment()->addGlobal("current_path", $container->get('request')->getUri()->getPath() );

    return $view;
};

$container['pdo'] = function($container){

    $pdo = new \PDO("sqlite:".__DIR__."/sql/db");

    return $pdo;
};

$container['auth'] = function($container){

    $db = $container->pdo;

    $auth = new \Delight\Auth\Auth($db);

    return $auth;
};



// -----------------------------------------------------------------------------
// Actions - Repositories - Factories
// -----------------------------------------------------------------------------
//Actions


$container['HomeAction'] = function($container) {
    
    return new App\Actions\HomeAction($container);
};


$container['AdminAction'] = function($container) {
    
    return new App\Actions\AdminAction($container);
};


/*$container['HomeRepository'] = function($container) {
    return new \app\Repositories\HomeRepository($container);
};*/