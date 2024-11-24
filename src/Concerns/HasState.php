<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Interfail\Concerns;

use BaseCodeOy\Interfail\Data\State;
use Illuminate\Support\Facades\Cache;

trait HasState
{
    private bool $shouldCacheState = true;

    public function withStateCache(): self
    {
        $this->shouldCacheState = true;

        return $this;
    }

    public function withoutStateCache(): self
    {
        $this->shouldCacheState = false;

        return $this;
    }

    private function storeState(): void
    {
        if ($this->shouldCacheState) {
            Cache::put($this->getCacheKey(), $this->state->toArray());
        }
    }

    private function restoreState(): void
    {
        if (Cache::has($this->getCacheKey())) {
            $this->state = new State(...Cache::get($this->getCacheKey()));
        } else {
            $this->state = new State(0, 0, []);

            $this->storeState();
        }
    }

    private function getCacheKey(): string
    {
        return 'interfail:'.$this->id;
    }
}
