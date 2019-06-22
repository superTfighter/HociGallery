<?php

namespace App\Repositories;

use App\Traits\CoreTrait;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Stream;

class ImageRepository
{
    use CoreTrait;


    public function getImages()
    {
        $db = $this->container->pdo;

        try {
                   
        $data = $db->select('SELECT name, url FROM images');

        return $data;


        } catch (\Exception $e) {

        	return array(
                'code'    => 400,
                'info'    => 'Invalid parameter',
                'status'  => 'ERROR',
                'statusText' => 'Hibás adatok!'
            );
        }




    }






}