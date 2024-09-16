<?php

namespace src\app;

use CoffeeCode\DataLayer\DataLayer;

class Users extends DataLayer
{
    public function __construct()
    {
        parent::__construct("users", ["first_name", "password"]);
    }
}