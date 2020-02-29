<?php
namespace Middleware;

class ExampleMiddleware
{
    public function __invoke($request, $response, $next)
    {
        // $response->getBody()->write('BEFORE');
        // \file_put_contents('./assets/log.txt' , "log test\n", FILE_APPEND | LOCK_EX );
        
        $response = $next($request, $response);

        // $response->getBody()->write('AFTER');

        return $response;
    }
}
