<?php

declare(strict_types=1);

namespace PreemStudio\Interfail\Contracts;

use PreemStudio\Interfail\Data\Result;

interface Extension
{
    public function onSuccess(Result $result): void;

    public function onFailure(Result $result): void;

    public function toArray(): array;
}
