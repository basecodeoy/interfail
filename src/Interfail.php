<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Interfail;

use BaseCodeOy\Interfail\Concerns\HasExtensions;
use BaseCodeOy\Interfail\Concerns\HasRetries;
use BaseCodeOy\Interfail\Concerns\HasState;
use BaseCodeOy\Interfail\Data\Result;
use BaseCodeOy\Interfail\Data\State;
use BaseCodeOy\PackagePowerPack\Package\Concerns\HasBootableTraits;
use Spatie\Macroable\Macroable;

final class Interfail
{
    use HasBootableTraits;
    use HasExtensions;
    use HasRetries;
    use HasState;
    use Macroable;

    private State $state;

    public function __construct(
        private readonly string $id,
    ) {
        $this->bootTraits();

        $this->restoreState();
    }

    public static function make(string $id): self
    {
        return new self($id);
    }

    public function run(callable $callback): Result
    {
        try {
            $result = new Result(
                retry($this->retry?->times, $callback, $this->retry?->sleepMilliseconds, $this->retry?->when),
                $this->state,
                null,
            );

            foreach ($this->extensions as $extension) {
                $extension->onSuccess($result);
            }

            $this->state->consecutiveFailures = 0;

            $this->storeState();

            return $result;
        } catch (\Throwable $th) {
            $result = new Result(null, $this->state, $th);

            $this->state->consecutiveFailures++;
            $this->state->totalFailures++;

            foreach ($this->extensions as $extension) {
                $extension->onFailure($result);
            }

            $this->storeState();

            return $result;
        }
    }
}
