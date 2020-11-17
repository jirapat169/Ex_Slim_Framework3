<?php
namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class Home
{
    public function index(Request $request, Response $response, $args)
    {
        $response->getBody()->write(\json_encode("Welcome to Slim Framework 3"));
        return $response;
    }
}
