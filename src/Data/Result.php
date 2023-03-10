<?php

declare(strict_types=1);

namespace PreemStudio\Interfail\Data;

use Spatie\LaravelData\Data;
use Spatie\Macroable\Macroable;
use Throwable;

final class Result extends Data
{
    use Macroable;

    public function __construct(
        public readonly mixed $result,
        public readonly State $state,
        public readonly ?Throwable $exception,
    ) {
        //
    }

    public function hasPassed(): bool
    {
        return empty($this->exception);
    }

    public function hasFailed(): bool
    {
        return ! empty($this->exception);
    }

    public function throw(): self
    {
        if (empty($this->exception)) {
            return $this;
        }

        throw $this->exception;
    }
}
