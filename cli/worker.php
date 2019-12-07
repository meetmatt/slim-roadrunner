<?php declare(strict_types=1);

use Spiral\Goridge\StreamRelay;
use Spiral\RoadRunner\Worker;
use Spiral\RoadRunner\PSR7Client;
use Nyholm\Psr7\Factory\Psr17Factory;

ini_set('display_errors', 'stderr');
include __DIR__ . '/../vendor/autoload.php';

$relay   = new StreamRelay(STDIN, STDOUT);
$worker  = new Worker($relay);
$factory = new Psr17Factory();
$client  = new PSR7Client($worker, $factory, $factory, $factory);

while ($req = $client->acceptRequest()) {
    try {
        $response = $factory->createResponse();
        $response->getBody()->write('Road runner');
        $client->respond($response);
    } catch (Throwable $e) {
        $client->getWorker()->error((string)$e);
    }
}