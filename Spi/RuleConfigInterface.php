<?php
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
