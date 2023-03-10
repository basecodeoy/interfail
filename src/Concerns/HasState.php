<?php

declare(strict_types=1);

namespace PreemStudio\Interfail\Concerns;

use Illuminate\Support\Facades\Cache;
use PreemStudio\Interfail\Data\State;

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
            $this->state = State::from(Cache::get($this->getCacheKey()));
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
