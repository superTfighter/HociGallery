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
        
        //$this->register('xeltomi71@gmail.com','asdasd123','admin');
        //$this->login('xeltomi71@gmail.com','asdasd123');

        if ($this->container->auth->isLoggedIn()) {
            echo 'User is signed in';
        }
        else {
            echo 'User is not signed in yet';
        }

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