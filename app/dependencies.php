<?php

use Slim\Views\Twig;
use PHPMailer\PHPMailer\PHPMailer;

$container = $app->getContainer();



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



// -----------------------------------------------------------------------------
// Actions - Repositories - Factories
// -----------------------------------------------------------------------------
//Actions


$container['HomeAction'] = function($container) {
    
    return new App\Actions\HomeAction($container);
};


/*$container['HomeRepository'] = function($container) {
    return new \app\Repositories\HomeRepository($container);
};*/