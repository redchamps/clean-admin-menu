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
interface RuleConfigInterface
{
    public function getRuleId(): string;

    public function getItems(): array;

    public function getDefaultItems(): array;
}
