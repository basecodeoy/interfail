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
use Carbon\Carbon;

final readonly class DeadlineExtension implements Extension
{
    public function __construct(
        private Carbon $date,
    ) {
        //
    }

    #[\Override()]
    public function onSuccess(Result $result): void
    {
        if ($this->date->isPast()) {
            throw new \RuntimeException('Deadline has been exceeded.');
        }
    }

    #[\Override()]
    public function onFailure(Result $result): void
    {
        //
    }

    #[\Override()]
    public function toArray(): array
    {
        return ['date' => $this->date];
    }
}
