<?php

declare(strict_types=1);

namespace BombenProdukt\Interfail\Extensions;

use BombenProdukt\Interfail\Contracts\Extension;
use BombenProdukt\Interfail\Data\Result;
use Carbon\Carbon;
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
