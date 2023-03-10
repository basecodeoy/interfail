<?php

declare(strict_types=1);

namespace PreemStudio\Interfail\Extensions;

use PreemStudio\Interfail\Contracts\Extension;
use PreemStudio\Interfail\Data\Result;
use RuntimeException;

final class ConsecutiveFailuresAllowedExtension implements Extension
{
    public function __construct(private readonly string $count)
    {
        //
    }

    public function onSuccess(Result $result): void
    {
        //
    }

    public function onFailure(Result $result): void
    {
        if ($result->state->consecutiveFailures >= $this->count) {
            throw new RuntimeException('Total number of allowed consecutive failures has been exceeded.');
        }
    }

    public function toArray(): array
    {
        return ['count' => $this->count];
    }
}
