<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Block;

use Magento\Backend\Block\Menu;
use RedChamps\CleanMenu\Model\Config;
use function reset;

final class MenuBlock
{
    public function beforeRenderNavigation(
        Menu $subject,
        Menu $menu,
        int $level = 0,
        int $limit = 0,
        array $colBrakes = []
    ): array {
        if ($level === 1) {
            $firstItem = reset($menu);
            if ($firstItem && $firstItem->toArray()['toolTip'] === Config::MENU_ID) {
                $level = 0;
            }
        }

        return [$menu, $level, $limit, $colBrakes];
    }
}
