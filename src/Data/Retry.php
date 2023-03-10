<?php

declare(strict_types=1);

namespace PreemStudio\Interfail\Data;

use Closure;
use Spatie\LaravelData\Data;

final class Retry extends Data
{
    public function __construct(
        public readonly int|array $times,
        public readonly int|Closure $sleepMilliseconds,
        public readonly Closure|null $when,
    ) {
        //
    }
}
