<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Interfail\Extensions;

use BaseCodeOy\Interfail\Contracts\Extension;
use BaseCodeOy\Interfail\Data\Result;

final class ConsecutiveFailuresAllowedExtension implements Extension
{
    public function __construct(
        private readonly string $count,
    ) {
        //
    }

    public function onSuccess(Result $result): void
    {
        //
    }

    public function onFailure(Result $result): void
    {
        if ($result->state->consecutiveFailures >= $this->count) {
            throw new \RuntimeException('Total number of allowed consecutive failures has been exceeded.');
        }
    }

    public function toArray(): array
    {
        return ['count' => $this->count];
    }
}
