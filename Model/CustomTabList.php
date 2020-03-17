<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use Magento\Config\Model\Config\Structure\Data;
use RedChamps\CleanMenu\Spi\ListInterface;
use function array_column;
use function array_combine;
use function array_flip;
use function array_keys;

final class CustomTabList implements ListInterface
{
    private const MANDATORY_TABS = [
        'general',
        'catalog',
        'customer',
        'sales',
        'service',
        'security',
        'advanced',
        'extensions_list',
    ];

    /**
     * @var Data
     */
    private $structureData;

    /**
     * @var string[]
     */
    private $list;

    public function __construct(
        Data $structureData
    ) {
        $this->structureData = $structureData;
    }

    public function getList(): array
    {
        return $this->list ?? $this->list = $this->resolveCustomTabs();
    }

    private function resolveCustomTabs(): array
    {
        $data = $this->structureData->get();

        $tabs = array_diff_key($data['tabs'], array_flip(self::MANDATORY_TABS));

        return array_combine(array_keys($tabs), array_column($tabs, 'label'));
    }
}
