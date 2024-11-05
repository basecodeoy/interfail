<?php

declare(strict_types=1);

namespace BaseCodeOy\Interfail\Contracts;

use BaseCodeOy\Interfail\Data\Result;

interface Extension
{
    public function onSuccess(Result $result): void;

    public function onFailure(Result $result): void;

    public function toArray(): array;
}
