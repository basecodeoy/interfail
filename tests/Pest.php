<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Interfail\Data\Result;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature');

uses(
    Tests\TestCase::class,
)->in('Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOk', function (): void {
    expect($this->value)->toBeInstanceOf(Result::class);
    expect($this->value->result)->toBe('Hello, World!');
    expect($this->value->state->consecutiveFailures)->toBe(0);
    expect($this->value->state->totalFailures)->toBe(0);
    expect($this->value->throwable)->toBeNull();
    expect($this->value->hasPassed())->toBeTrue();
    expect($this->value->hasFailed())->toBeFalse();
});

expect()->extend('toBeErr', function (): void {
    expect($this->value)->toBeInstanceOf(Result::class);
    expect($this->value->result)->toBeNull();
    expect($this->value->state->consecutiveFailures)->toBe(1);
    expect($this->value->state->totalFailures)->toBe(1);
    expect($this->value->throwable)->toBeInstanceOf(RuntimeException::class);
    expect($this->value->hasPassed())->toBeFalse();
    expect($this->value->hasFailed())->toBeTrue();
});

expect()->extend('toHaveErrors', function (int $consecutiveFailures, int $totalFailures): void {
    expect($this->value->state->consecutiveFailures)->toBe($consecutiveFailures);
    expect($this->value->state->totalFailures)->toBe($totalFailures);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something(): void
{
    // ..
}
