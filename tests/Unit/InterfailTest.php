<?php

declare(strict_types=1);

namespace Tests\Unit;

use BombenProdukt\Interfail\Interfail;
use Illuminate\Support\Facades\Cache;
use RuntimeException;

it('should execute the function and pass', function (): void {
    expect(Interfail::make('id')->run(fn () => 'Hello, World!'))->toBeOk();
});

it('should execute the function and fail', function (): void {
    expect(Interfail::make('id')->run(fn () => throw new RuntimeException('Yikes!')))->toBeErr();
});

it('should execute the function and fail with 2 consecutive failures', function (): void {
    $session = Interfail::make('id');

    expect($session->run(fn () => throw new RuntimeException('Yikes!')))->toHaveErrors(1, 1);
    expect($session->run(fn () => throw new RuntimeException('Yikes!')))->toHaveErrors(2, 2);
    expect($session->run(fn () => 'Hello, World!'))->toHaveErrors(0, 2);
    expect($session->run(fn () => throw new RuntimeException('Yikes!')))->toHaveErrors(1, 3);
});

it('should restore the state between instances', function (): void {
    Cache::flush();

    expect(Interfail::make('id')->run(fn () => throw new RuntimeException('Yikes!')))->toHaveErrors(1, 1);
    expect(Interfail::make('id')->run(fn () => throw new RuntimeException('Yikes!')))->toHaveErrors(2, 2);
    expect(Interfail::make('id')->run(fn () => 'Hello, World!'))->toHaveErrors(0, 2);
    expect(Interfail::make('id')->run(fn () => throw new RuntimeException('Yikes!')))->toHaveErrors(1, 3);
});
