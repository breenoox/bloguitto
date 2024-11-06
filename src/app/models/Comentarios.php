<?php

namespace src\app\models;

use CoffeeCode\DataLayer\DataLayer;
use src\app\models\Users;

class Comentario extends DataLayer
{
    public function __construct()
    {
        parent::__construct("comentarios", ["post_id", "descricao", "user_id"]);
    }
}