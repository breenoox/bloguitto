<?php

namespace src\app\models;

use CoffeeCode\DataLayer\DataLayer;

class Posts extends DataLayer
{
    public function __construct()
    {
        parent::__construct("posts", ["user_id", "title", "description"], "post_id");
    }
}