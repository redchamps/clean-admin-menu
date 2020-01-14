<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use Magento\Config\Model\Config\Structure\Data;
use function array_column;
use function array_diff;
use function array_unique;

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

        return array_diff(array_unique(array_column($data['sections'], 'tab')), self::MANDATORY_TABS);
    }
}
