<?php

namespace App\Factories;

use App\Traits\CoreTrait;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Stream;

class ImageFactory
{
    use CoreTrait;


    public function imageToDB($name,$url)
    {
        $db = $this->container->pdo;

        $data = 
        [
            'name' => $name,
            'url' => $url
        ];

        try {
                   
            $db->insert(
                'images',$data
            );

        return $newId = $db->getLastInsertId();


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