<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Backend\Model\Menu\Builder\AbstractCommand;
use RedChamps\CleanMenu\Api\IsAllowedInterface;
use RedChamps\CleanMenu\Model\Config;

final class MenuBuilderCommand
{
    /**
     * @var IsAllowedInterface
     */
    private $isAllowed;

    private $isAllowedMenuId;

    public function __construct(
        IsAllowedInterface $isAllowed,
        IsAllowedInterface $isAllowedMenuId
    ) {
        $this->isAllowed = $isAllowed;
        $this->isAllowedMenuId = $isAllowedMenuId;
    }

    public function afterExecute(AbstractCommand $subject, $result): array
    {
        if (
            $this->isAllowedMenuId->isAllowed($result['id']) ||
            (
                isset($result['module']) &&
                !isset($result['parent']) &&
                !$this->isAllowed->isAllowed($result['module'])
            )
        ) {
            $result['parent'] = Config::MENU_ID;
        }

        return $result;
    }
}
