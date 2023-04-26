<?php

declare(strict_types=1);

namespace BombenProdukt\Interfail\Extensions;

use BombenProdukt\Interfail\Contracts\Extension;
use BombenProdukt\Interfail\Data\Result;
use RuntimeException;

final class TotalFailuresAllowedExtension implements Extension
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
        if ($result->state->totalFailures >= $this->count) {
            throw new RuntimeException('Total number of allowed failures has been exceeded.');
        }
    }

    public function toArray(): array
    {
        return ['count' => $this->count];
    }
}
