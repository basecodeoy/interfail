<?php

declare(strict_types=1);

namespace PreemStudio\Interfail\Concerns;

use PreemStudio\Interfail\Contracts\Extension;

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
