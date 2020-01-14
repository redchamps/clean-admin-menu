<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

/**
 * @api
 */
interface ListInterface
{
    /**
     * @return string[]
     */
    public function getList(): array;
}
