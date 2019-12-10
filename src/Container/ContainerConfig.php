<?php

namespace MeetMatt\SlimRoadRunner\Container;

use MeetMatt\SlimRoadRunner\Action\HelloWorld;
use MeetMatt\SlimRoadRunner\Spiral\StandardStreamRelay;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Slim\App;
use Spiral\Goridge\RelayInterface;
use Spiral\RoadRunner\PSR7Client;
use WoohooLabs\Zen\Config\AbstractContainerConfig;
use WoohooLabs\Zen\Config\EntryPoint\ClassEntryPoint;
use WoohooLabs\Zen\Config\EntryPoint\Psr4NamespaceEntryPoint;

class ContainerConfig extends AbstractContainerConfig
{
    protected function getEntryPoints(): array
    {
        return [
            ClassEntryPoint::create(App::class)->autoload(),
            ClassEntryPoint::create(PSR7Client::class)->autoload(),
            Psr4NamespaceEntryPoint::create('MeetMatt\\SlimRoadRunner\\Action')->autoload(),
        ];
    }

    protected function getDefinitionHints(): array
    {
        return [
            ResponseFactoryInterface::class      => Psr17Factory::class,
            ServerRequestFactoryInterface::class => Psr17Factory::class,
            StreamFactoryInterface::class        => Psr17Factory::class,
            UploadedFileFactoryInterface::class  => Psr17Factory::class,
            RelayInterface::class                => StandardStreamRelay::class,
        ];
    }

    protected function getWildcardHints(): array
    {
        return [];
    }
}