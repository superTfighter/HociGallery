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
        $getImages = $this->ImageRepository->getImages();

        $images = array_slice($getImages,0,9);


        return $this->view->render($response,'home/index.twig',['images' => $images]);
    }

}