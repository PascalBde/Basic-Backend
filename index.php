<?php
require("init.php");

/*
 * VIEW ROUTES
 */


// index route, render the basic html view
$router->get("/", function ($request, $response, $args) {
echo "huhu pascal";
});

$router->get("/freund", function ($request, $response, $args) {
    echo "huhu freund";
});


$router->run();