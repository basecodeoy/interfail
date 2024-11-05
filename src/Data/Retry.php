<?php

declare(strict_types=1);

namespace BaseCodeOy\Interfail\Data;

use Closure;

final class Retry
{
    public function __construct(
        public readonly int|array $times,
        public readonly int|Closure $sleepMilliseconds,
        public readonly ?Closure $when,
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
