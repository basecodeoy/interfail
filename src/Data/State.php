<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
