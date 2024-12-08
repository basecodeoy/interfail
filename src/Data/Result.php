<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Interfail\Data;

use Spatie\Macroable\Macroable;

final class Result
{
    use Macroable;

    public function __construct(
        public readonly mixed $result,
        public readonly State $state,
        public readonly ?\Throwable $throwable,
    ) {
        //
    }

    public function hasPassed(): bool
    {
        return !$this->throwable instanceof \Throwable;
    }

    public function hasFailed(): bool
    {
        return $this->throwable instanceof \Throwable;
    }

    public function throw(): self
    {
        if (!$this->throwable instanceof \Throwable) {
            return $this;
        }

        throw $this->throwable;
    }

    public function toArray(): array
    {
        return [
            'result' => $this->result,
            'state' => $this->state,
            'exception' => $this->throwable,
        ];
    }
}
