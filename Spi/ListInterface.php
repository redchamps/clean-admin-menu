<?php
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
