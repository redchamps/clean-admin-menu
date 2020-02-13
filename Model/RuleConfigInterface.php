<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

interface RuleConfigInterface
{
    public function getRuleId(): string;

    public function getItems(): array;

    public function getDefaultItems(): array;
}
