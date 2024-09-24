<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/ConfigRouter.php";
require __DIR__ . "/src/Config.php";
require __DIR__ . "/src/app/controllers/PostsController.php";
require __DIR__ . "/src/app/controllers/UsersController.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

$router->namespace("src\\app\\controllers");

$router->group(null);
$router->get("/", "PostsController:readPosts");

$router->get("/login", "UsersController:login");
$router->post("/login", "UsersController:login");

$router->get("/register", "UsersController:register");
$router->post("/register", "UsersController:register");

$router->get("/logout", "UsersController:logout");

$router->get("/create", "PostsController:createPost");
$router->post("/create", "PostsController:createPost");

$router->delete("/delete/{id}", "PostsController:deletePost");

$router->get("/edit/{id}", "PostsController:edit");
$router->post("/update", "PostsController:updatePost");

//$router->post("/like/toggle/{postId}", "LikesController:likePost");

$router->dispatch();