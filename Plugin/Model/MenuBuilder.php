<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu;
use Magento\Backend\Model\Menu\Builder;
use RedChamps\CleanMenu\Model\Config;

final class MenuBuilder
{
    public function afterGetResult(Builder $subject, Menu $result): Menu
    {
        if ($result && $result->get(Config::MENU_ID)) {
            foreach ($result->get(Config::MENU_ID)->getChildren() as $child) {
                if ($child->isAllowed()) {
                    return $result;
                }
            }
            $result->remove(Config::MENU_ID);
        }

        return $result;
    }
}
