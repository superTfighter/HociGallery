<?php

namespace App\Actions;

use App\Traits\CoreTrait;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Stream;

class VisitorAction
{
    use CoreTrait;

    public function index($request,$response, $args)
    {
        $getImages = $this->ImageRepository->getImages();

        $images = array_slice($getImages,0,9);


        return $this->view->render($response,'visitor/index.twig',['images' => $images]);
    }

    public function getGallery($request,$response,$args)
    {

        $getImages = $this->ImageRepository->getImages();


        return $this->view->render($response,'visitor/asdasd.twig',['images' => $getImages]);
    }


    public function getImagesJson($request,$response,$args)
    {

        $getImages = $this->ImageRepository->getImages();

        $data['data'] = $getImages;

        return $response->withJson($data);
    
    }
}