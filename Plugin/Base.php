<?php
namespace RedChamps\CleanMenu\Plugin;

class Base
{
    const MENU_ID = "RedChamps_CleanMenu::extensions";

    protected function getFirstItem($items)
    {
        $firstItem = false;
        foreach ($items as $item) {
            $firstItem = $item;
            break;
        }
        return $firstItem;
    }
}
