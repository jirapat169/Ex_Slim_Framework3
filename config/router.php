<?php

$app->get('/', \Controller\Home::class . ":index")->add(new \Middleware\ExampleMiddleware());
