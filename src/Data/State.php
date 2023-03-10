<?php

declare(strict_types=1);

namespace PreemStudio\Interfail\Data;

use Spatie\LaravelData\Data;
use Spatie\Macroable\Macroable;

final class State extends Data
{
    use Macroable;

    public function __construct(
        public int $totalFailures,
        public int $consecutiveFailures,
        public array $meta,
    ) {
        //
    }
}
