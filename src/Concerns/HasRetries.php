<?php

declare(strict_types=1);

namespace BaseCodeOy\Interfail\Concerns;

use BaseCodeOy\Interfail\Data\Retry;
use Closure;

trait HasRetries
{
    private Retry $retry;

    public function bootHasRetries(): void
    {
        $this->retry = new Retry(0, 0, null);
    }

    public function retry(
        int|array $times,
        int|Closure $sleepMilliseconds,
        ?Closure $when,
    ): self {
        $this->retry = new Retry($times, $sleepMilliseconds, $when);

        return $this;
    }
}
