<?php
namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class Home
{
    public function index(Request $request, Response $response, $args)
    {
        $ipAddress = $request->getAttribute('ip_address');
        $response->getBody()->write(\json_encode($ipAddress));
        return $response;
    }
}
