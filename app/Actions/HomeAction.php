<?php

namespace App\Actions;

use App\Traits\CoreTrait;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Stream;

class HomeAction
{
    use CoreTrait;

    public function index($request,$response, $args)
    {

        //\Cloudinary\Uploader::upload(__DIR__ . "/../images/author.jpg");

        return $this->view->render($response,'home/index.twig');
    }

}