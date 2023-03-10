<?php

declare(strict_types=1);

use PreemStudio\Interfail\Data\Result;
use Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

expect()->extend('toBeOk', function () {
    expect($this->value)->toBeInstanceOf(Result::class);
    expect($this->value->result)->toBe('Hello, World!');
    expect($this->value->state->consecutiveFailures)->toBe(0);
    expect($this->value->state->totalFailures)->toBe(0);
    expect($this->value->exception)->toBeNull();
    expect($this->value->hasPassed())->toBeTrue();
    expect($this->value->hasFailed())->toBeFalse();
});

expect()->extend('toBeErr', function () {
    expect($this->value)->toBeInstanceOf(Result::class);
    expect($this->value->result)->toBeNull();
    expect($this->value->state->consecutiveFailures)->toBe(1);
    expect($this->value->state->totalFailures)->toBe(1);
    expect($this->value->exception)->toBeInstanceOf(RuntimeException::class);
    expect($this->value->hasPassed())->toBeFalse();
    expect($this->value->hasFailed())->toBeTrue();
});

expect()->extend('toHaveErrors', function (int $consecutiveFailures, int $totalFailures) {
    expect($this->value->state->consecutiveFailures)->toBe($consecutiveFailures);
    expect($this->value->state->totalFailures)->toBe($totalFailures);
});
