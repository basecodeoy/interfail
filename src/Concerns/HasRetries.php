<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Interfail\Concerns;

use BaseCodeOy\Interfail\Data\Retry;

trait HasRetries
{
    private Retry $retry;

    public function bootHasRetries(): void
    {
        $this->retry = new Retry(0, 0, null);
    }

    public function retry(
        int|array $times,
        int|\Closure $sleepMilliseconds,
        ?\Closure $when,
    ): self {
        $this->retry = new Retry($times, $sleepMilliseconds, $when);

        return $this;
    }
}
