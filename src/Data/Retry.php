<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Interfail\Data;

final readonly class Retry
{
    public function __construct(
        public int|array $times,
        public int|\Closure $sleepMilliseconds,
        public ?\Closure $when,
    ) {
        //
    }

    public function toArray(): array
    {
        return [
            'times' => $this->times,
            'sleepMilliseconds' => $this->sleepMilliseconds,
            'when' => $this->when,
        ];
    }
}
