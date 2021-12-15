<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu\Item;
use RedChamps\CleanMenu\Model\Config;
use RedChamps\CleanMenu\Model\IsAllowedMenuChildren;

final class MenuItem
{
    private $isAllowedMenuChildren;

    public function __construct(IsAllowedMenuChildren $isAllowedMenuChildren)
    {
        $this->isAllowedMenuChildren = $isAllowedMenuChildren;
    }

    public function afterGetChildren(Item $subject, $result)
    {
        if ($subject->getId() === Config::MENU_ID) {
            $firstItem = $result->getFirstAvailable();
            if ($firstItem && $firstItem->getId()) {
                $firstItem->setTooltip(Config::MENU_ID);
            }
        }

        return $result;
    }

    public function afterIsAllowed(Item $subject, bool $result): bool
    {
        return ($subject->toArray()['resource'] ?? '') === Config::MENU_ID
            ? $this->isAllowedMenuChildren->execute($subject)
            : $result;
    }
}
