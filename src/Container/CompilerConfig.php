<?php

namespace MeetMatt\SlimRoadRunner\Container;

use WoohooLabs\Zen\Config\AbstractCompilerConfig;

class CompilerConfig extends AbstractCompilerConfig
{
    public function getContainerNamespace(): string
    {
        return 'MeetMatt\\SlimRoadRunner\\Container';
    }

    public function getContainerClassName(): string
    {
        return 'Container';
    }

    public function useConstructorInjection(): bool
    {
        return true;
    }

    public function usePropertyInjection(): bool
    {
        return false;
    }

    public function getContainerConfigs(): array
    {
        return [
            new ContainerConfig(),
        ];
    }
}