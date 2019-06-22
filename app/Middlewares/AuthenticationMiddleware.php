<?php

namespace App\Middlewares;

use App\Traits\CoreTrait;

class AuthenticationMiddleware
{
    use CoreTrait;

    public function __invoke($request, $response, $next)
    {

        if (!$this->container->auth->isLoggedIn()) {

            return $response->withStatus(403);

        }
        else {
            
            $response = $next($request, $response);

            return $response;
        }

        die();
        
        
    }

}
