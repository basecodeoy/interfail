<?php

declare(strict_types=1);

namespace PreemStudio\Interfail\Extensions;

use Carbon\Carbon;
use PreemStudio\Interfail\Contracts\Extension;
use PreemStudio\Interfail\Data\Result;
use RuntimeException;

final class DeadlineExtension implements Extension
{
    public function __construct(private readonly Carbon $date)
    {
        //
    }

    public function onSuccess(Result $result): void
    {
        if ($this->date->isPast()) {
            throw new RuntimeException('Deadline has been exceeded.');
        }
    }

    public function onFailure(Result $result): void
    {
        //
    }

    public function toArray(): array
    {
        return ['date' => $this->date];
    }
}
