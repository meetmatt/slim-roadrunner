<?php declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;
use Spiral\Goridge\StreamRelay;
use Spiral\RoadRunner\Worker;
use Spiral\RoadRunner\PSR7Client;
use Nyholm\Psr7\Factory\Psr17Factory;

ini_set('display_errors', 'stderr');
error_reporting(E_ALL);
chdir(__DIR__);
set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

include __DIR__ . '/../vendor/autoload.php';
// $container = require __DIR__ . '/../config/container.php';

$relay   = new StreamRelay(STDIN, STDOUT);
$worker  = new Worker($relay);
$factory = new Psr17Factory();
$client  = new PSR7Client($worker, $factory, $factory, $factory);

$application = AppFactory::create();
$application->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
    $response->getBody()->write('Slim on Road Runner');

    return $response;
});

while ($request = $client->acceptRequest()) {
    try {
        $response = $application->handle($request);
        $client->respond($response);
    } catch (Throwable $e) {
        $client->getWorker()->error((string)$e);
    }
    gc_collect_cycles();
}