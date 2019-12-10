<?php declare(strict_types=1);

use MeetMatt\SlimRoadRunner\Action\HelloWorld;
use MeetMatt\SlimRoadRunner\Action\IndexPage;
use MeetMatt\SlimRoadRunner\Container\Container;
use Slim\App;
use Spiral\RoadRunner\PSR7Client;

ini_set('display_errors', 'stderr');
error_reporting(E_ALL);
chdir(__DIR__);
set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

include __DIR__ . '/../vendor/autoload.php';

$container = new Container();

/** @var App $application */
$application = $container->get(App::class);

$application->get('/', IndexPage::class);
$application->get('/hello/{name}', HelloWorld::class);

/** @var PSR7Client $client */
$client = $container->get(PSR7Client::class);

while ($request = $client->acceptRequest()) {
    try {
        $response = $application->handle($request);
        $client->respond($response);
    } catch (Throwable $e) {
        $client->getWorker()->error((string)$e);
    }

    gc_collect_cycles();
}