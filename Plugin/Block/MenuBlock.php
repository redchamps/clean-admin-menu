<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Block;

use Magento\Backend\Block\Menu;
use RedChamps\CleanMenu\Model\Config;
use function reset;

final class MenuBlock
{
    public function beforeRenderNavigation(
        Menu $subject,
        $menu,
        int $level = 0,
        int $limit = 0,
        $colBrakes = []
    ): array {
        $firstItem = reset($menu);
        if ($level === 1 && $firstItem && $firstItem->toArray()['toolTip'] === Config::MENU_ID) {
            $level = 0;
        }

        return [$menu, $level, $limit, $colBrakes];
    }
}
