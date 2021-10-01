<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu\Item;
use RedChamps\CleanMenu\Model\Config;
use function reset;

final class MenuItem
{
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
        $menuItemData = $subject->toArray();

        return (($menuItemData["resource"] ?? '') === Config::MENU_ID) || $result;
    }
}
