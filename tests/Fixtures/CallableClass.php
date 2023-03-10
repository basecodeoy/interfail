<?php

declare(strict_types=1);

namespace Tests\Fixtures;

final class CallableClass
{
    public function execute(): string
    {
        return 'Hello, World!';
    }
}
