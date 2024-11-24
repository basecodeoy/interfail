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
        public readonly ?\Throwable $exception,
    ) {
        //
    }

    public function hasPassed(): bool
    {
        return empty($this->exception);
    }

    public function hasFailed(): bool
    {
        return !empty($this->exception);
    }

    public function throw(): self
    {
        if (empty($this->exception)) {
            return $this;
        }

        throw $this->exception;
    }

    public function toArray(): array
    {
        return [
            'result' => $this->result,
            'state' => $this->state,
            'exception' => $this->exception,
        ];
    }
}
