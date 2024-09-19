<?php

require "vendor/autoload.php";
require "src/ConfigRouter.php";
require "src/Config.php";
require "src/app/controllers/PostsController.php";


use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

$router->namespace("src\\app\\controllers");

$router->group(null);
$router->get("/", "PostsController:readPosts");

$router->get("/create", "PostsController:createPost");
$router->post("/create", "PostsController:createPost");

$router->delete("/delete/{id}", "PostsController:deletePost");

$router->get("/edit/{id}", "PostsController:edit");
$router->post("/update", "PostsController:updatePost");

$router->dispatch();