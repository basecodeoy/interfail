<?php

declare(strict_types=1);

namespace BaseCodeOy\Interfail\Extensions;

use BaseCodeOy\Interfail\Contracts\Extension;
use BaseCodeOy\Interfail\Data\Result;
use RuntimeException;

final class FailuresAllowedForSecondsExtension implements Extension
{
    public function __construct(private readonly string $seconds)
    {
        //
    }

    public function onSuccess(Result $result): void
    {
        //
    }

    public function onFailure(Result $result): void
    {
        if ($this->validate($result)) {
            return;
        }

        throw new RuntimeException('Total number of allowed failures has been exceeded.');
    }

    public function toArray(): array
    {
        return ['seconds' => $this->seconds];
    }
}
