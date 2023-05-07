<?php

namespace App\Factories;

use App\Access\AuthGithub;
use App\Access\AuthTypes;
use Exception;

class AuthFactory
{

    public static function getAuthInstance($method)
    {
        return match(true)
        {
            $method == AuthTypes::AUTH_GITHUB => new AuthGithub(),
            default => throw new Exception('Proveedor de autenticación no válido'),
        };
    }

}
