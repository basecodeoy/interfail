<?php

declare(strict_types=1);

namespace BaseCodeOy\Interfail\Data;

use Spatie\Macroable\Macroable;

final class State
{
    use Macroable;

    public function __construct(
        public int $totalFailures,
        public int $consecutiveFailures,
        public array $meta,
    ) {
        //
    }

    public function toArray(): array
    {
        return [
            'totalFailures' => $this->totalFailures,
            'consecutiveFailures' => $this->consecutiveFailures,
            'meta' => $this->meta,
        ];
    }
}
