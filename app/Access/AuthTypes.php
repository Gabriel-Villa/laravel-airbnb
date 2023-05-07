<?php

namespace App\Access;

class AuthTypes
{

    const AUTH_GITHUB = 'github';

    public static function getAvailableAuthMethods()
    {
        return [self::AUTH_GITHUB];
    }

}
