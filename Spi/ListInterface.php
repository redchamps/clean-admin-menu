<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Spi;

/**
 * @spi
 */
interface ListInterface
{
    /**
     * @return string[]
     */
    public function getList(): array;
}
