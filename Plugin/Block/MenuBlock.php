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
    const MAX_ITEMS = 10;

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
            $limit = self::MAX_ITEMS;
            if (is_array($colBrakes)) {
                foreach ($colBrakes as $key => $colBrake) {
                    if (isset($colBrake['colbrake'])
                        && $colBrake['colbrake']
                    ) {
                        $colBrakes[$key]['colbrake'] = false;
                    }

                    if (isset($colBrake['colbrake']) && (($key - 1) % $limit) === 0) {
                        $colBrakes[$key]['colbrake'] = true;
                    }
                }
            }
        }

        return [$menu, $level, $limit, $colBrakes];
    }
}
