<?php

require "vendor/autoload.php";
require "src/ConfigRouter.php";
require "src/Config.php";
require "src/app/Web.php";
require "src/app/DeletePost.php";
require "src/app/CreatePost.php";
require "src/app/UpdatePost.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

$router->namespace("src\\app");

$router->group(null);
$router->get("/", "Web:readPosts");

$router->get("/create", "CreatePost:createPost");
$router->post("/create", "CreatePost:createPost");

$router->delete("/delete/{id}", "DeletePost:deletePost");

$router->get("/edit/{id}", "UpdatePost:edit");
$router->post("/update", "UpdatePost:UpdatePost");

$router->dispatch();