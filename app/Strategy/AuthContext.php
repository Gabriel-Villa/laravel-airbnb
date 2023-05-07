<?php

namespace App\Strategy;

use App\Contracts\AuthStrategy;

class AuthContext
{

    public function __construct(public AuthStrategy $authStrategy){ }

    public function makeLogin()
    {
        $this->authStrategy->login();
    }

    public function setStrategy($strategy)
    {
        $this->authStrategy = $strategy;
    }

}
