<?php

namespace src\app\models;

use CoffeeCode\DataLayer\DataLayer;

class Likes extends DataLayer
{
    public function __construct() {
        parent::__construct("likes", ["user_id", "post_id"]);
    }
    
    public function countLikes($postId)
    {
        return $this->find("post_id = :post_id", "post_id={$postId}")->count();
    }
}