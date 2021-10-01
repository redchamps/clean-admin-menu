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
    private const MAX_ITEMS = 10;

    public function beforeRenderNavigation(
        Menu $subject,
        $menu,
        int $level = 0,
        int $limit = 0,
        ?array $colBrakes = null
    ): array {
        $firstItem = $menu->getFirstAvailable();

        if ($level === 1 && $firstItem && $firstItem->toArray()['toolTip'] === Config::MENU_ID) {
            $level = 0;
            $limit = self::MAX_ITEMS;
            foreach ($colBrakes ?? [] as $key => $colBrake) {
                if (isset($colBrake['colbrake'])) {
                    if ($colBrake['colbrake']) {
                        $colBrakes[$key]['colbrake'] = false;
                    } elseif ((($key - 1) % $limit) === 0) {
                        $colBrakes[$key]['colbrake'] = true;
                    }
                }
            }
        }

        return [$menu, $level, $limit, $colBrakes];
    }
}
