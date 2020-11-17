<?php
require './vendor/autoload.php';
require './config/service.php';
require "./config/container.php";

$app = new \Slim\App($container);

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
});

// Router
require './config/router.php';

$app->run();
