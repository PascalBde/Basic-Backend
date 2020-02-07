<?php
require("init.php");

$userObj = new user();
/*
 * VIEW ROUTES
 */

// index route, render the basic html view
$router->get("/", function () {
echo "huhu user";
});

// index route, render the basic html view
$router->any("/add/{email}/{password}", function ($request, $response, $args) use ($userObj) {

    
    $userId = $userObj->add($args["email"], $args["email"], $args["password"]);
    $user = $userObj->getUser($userId);
    return json_encode($user);
});

$router->post("/login", function ($request, $response, $args) use ($userObj) {
    //get XSS sanitized POST arguments
    $cleanPost = $_POST;
    if($userObj->login($cleanPost["email"], $cleanPost["password"])) {
        return $response->withStatus(301)->withHeader("Location", "http://127.0.0.1/cherrycake/index.php");
    }
});
$router->get("/login/{email}/{password}", function ($request, $response, $args) use ($userObj) {
    //get XSS sanitized POST arguments
    $cleanArgs = $args;

    return json_encode($userObj->login($cleanArgs["email"], $cleanArgs["password"]));
});
$router->get("/showAll", function ($request, $response, $args) use ($userObj) {
    //get XSS sanitized POST arguments
    $cleanArgs = $args;

    return json_encode($userObj->getAllUsers());
});
$router->get("/logout", function($request, $response, $args) use ($userObj) {
     if($userObj->logout()) {
         return $response->withStatus(301)->withHeader("Location", "http://127.0.0.1/cherrycake/index.php");
     }
});


$router->run();