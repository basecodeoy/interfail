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

final class FailuresAllowedForSecondsExtension implements Extension
{
    public function __construct(
        private readonly string $seconds,
    ) {
        //
    }

    public function onSuccess(Result $result): void
    {
        //
    }

    public function onFailure(Result $result): void
    {
        if ($this->validate($result)) {
            return;
        }

        throw new \RuntimeException('Total number of allowed failures has been exceeded.');
    }

    public function toArray(): array
    {
        return ['seconds' => $this->seconds];
    }
}
