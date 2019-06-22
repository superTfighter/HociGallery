<?php

namespace App\Actions;

use App\Traits\CoreTrait;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Stream;

class AdminAction
{
    use CoreTrait;

    public function loginPage($request,$response, $args)
    {
        if ($this->container->auth->isLoggedIn()) {

            return $response->withRedirect($this->router->pathFor('adminHome'));

        }
        else {
            return $this->view->render($response,'admin/login.twig');
        }

        return $this->view->render($response,'admin/login.twig');
    }

    public function loginPost($request,$response, $args)
    {

        $form_data = $request->getParams();
        $name = $form_data['email'];
        $pws = $form_data['pass'];

        $this->login($name,$pws);

        return $response->withRedirect($this->router->pathFor('adminHome')); 
    }

    public function home($request,$response, $args)
    { 

        return $this->view->render($response,'admin/admin_home.twig');
    }

    public function getUpload($request,$response, $args)
    { 

        return $this->view->render($response,'admin/admin_upload.twig');
    }

    public function uploadToDBAndApi($request,$response, $args)
    {
        $file = $request->getUploadedFiles()['file'];
        $name = $request->getParams()['name'];
        
        $url = \Cloudinary\Uploader::upload($file->file)['url'];
        
        $this->ImageFactory->imageToDB($name,$url);

        return $response->withRedirect($this->router->pathFor('adminUpload')); 

    }


    private function login($email,$psw)
    {

        try {
            $this->container->auth->login($email, $psw);
        
            echo 'User is logged in';
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            die('Wrong email address');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Wrong password');
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Email not verified');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }

    }


    private function register($email,$psw,$username)
    {
        try {

            $userId = $this->container->auth->register($email, $psw, $username);
        
            echo 'We have signed up a new user with the ID ' . $userId;
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid email address');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            die('User already exists');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
    }

}