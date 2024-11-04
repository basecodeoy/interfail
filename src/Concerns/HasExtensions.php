<?php

declare(strict_types=1);

namespace BaseCodeOy\Interfail\Concerns;

use BaseCodeOy\Interfail\Contracts\Extension;

trait HasExtensions
{
    /**
     * @var Extension[]
     */
    private array $extensions = [];

    public function addExtension(Extension $extension): self
    {
        $this->extensions[] = $extension;

        return $this;
    }
}
