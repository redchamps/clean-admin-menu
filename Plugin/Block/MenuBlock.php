<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Block;

use Magento\Backend\Block\Menu;
use RedChamps\CleanMenu\Model\Config;
use function reset;

final class MenuBlock
{
    public function beforeRenderNavigation(Menu $subject, $menu, $level = 0, $limit = 0, $colBrakes = [])
    {
        $firstItem = reset($menu);
        if ($firstItem && $firstItem->toArray()['toolTip'] === Config::MENU_ID) {
            $level = $level === 1 ? 0 : $level;
        }

        return [$menu, $level, $limit, $colBrakes];
    }
}
