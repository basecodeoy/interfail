<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit;

use BaseCodeOy\Interfail\Interfail;
use Illuminate\Support\Facades\Cache;

it('should execute the function and pass', function (): void {
    expect(Interfail::make('id')->run(fn (): string => 'Hello, World!'))->toBeOk();
});

it('should execute the function and fail', function (): void {
    expect(Interfail::make('id')->run(fn () => throw new \RuntimeException('Yikes!')))->toBeErr();
});

it('should execute the function and fail with 2 consecutive failures', function (): void {
    $interfail = Interfail::make('id');

    expect($interfail->run(fn () => throw new \RuntimeException('Yikes!')))->toHaveErrors(1, 1);
    expect($interfail->run(fn () => throw new \RuntimeException('Yikes!')))->toHaveErrors(2, 2);
    expect($interfail->run(fn (): string => 'Hello, World!'))->toHaveErrors(0, 2);
    expect($interfail->run(fn () => throw new \RuntimeException('Yikes!')))->toHaveErrors(1, 3);
});

it('should restore the state between instances', function (): void {
    Cache::flush();

    expect(Interfail::make('id')->run(fn () => throw new \RuntimeException('Yikes!')))->toHaveErrors(1, 1);
    expect(Interfail::make('id')->run(fn () => throw new \RuntimeException('Yikes!')))->toHaveErrors(2, 2);
    expect(Interfail::make('id')->run(fn (): string => 'Hello, World!'))->toHaveErrors(0, 2);
    expect(Interfail::make('id')->run(fn () => throw new \RuntimeException('Yikes!')))->toHaveErrors(1, 3);
});
