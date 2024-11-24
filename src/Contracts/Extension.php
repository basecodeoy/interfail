<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Interfail\Contracts;

use BaseCodeOy\Interfail\Data\Result;

interface Extension
{
    public function onSuccess(Result $result): void;

    public function onFailure(Result $result): void;

    public function toArray(): array;
}
