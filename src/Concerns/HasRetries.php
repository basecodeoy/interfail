<?php

declare(strict_types=1);

namespace PreemStudio\Interfail\Concerns;

use Closure;
use PreemStudio\Interfail\Data\Retry;

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
        Closure|null $when,
    ): self {
        $this->retry = new Retry($times, $sleepMilliseconds, $when);

        return $this;
    }
}
