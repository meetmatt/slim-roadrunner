<?php

namespace MeetMatt\SlimRoadRunner\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class IndexPage
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write('Slim + RoadRunner = 💙');

        return $response;
    }
}