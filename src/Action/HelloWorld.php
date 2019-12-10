<?php

namespace MeetMatt\SlimRoadRunner\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HelloWorld
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $response->getBody()->write(sprintf('Hello %s', $args['name']));

        return $response;
    }
}