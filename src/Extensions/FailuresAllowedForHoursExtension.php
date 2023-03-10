<?php

declare(strict_types=1);

namespace PreemStudio\Interfail\Extensions;

use PreemStudio\Interfail\Contracts\Extension;
use PreemStudio\Interfail\Data\Result;
use RuntimeException;

final class FailuresAllowedForHoursExtension implements Extension
{
    public function __construct(private readonly string $hours)
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
        return ['hours' => $this->hours];
    }
}
