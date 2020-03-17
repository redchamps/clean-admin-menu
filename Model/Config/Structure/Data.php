<?php
/**
 * Copyright © RedChamps, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model\Config\Structure;

use Magento\Config\Model\Config\Structure\Data as StructureData;
use Magento\Config\Model\Config\Structure\Reader;
use Magento\Framework\Config\CacheInterface;
use Magento\Framework\Config\ScopeInterface;
use Magento\Framework\Serialize\SerializerInterface;
use RedChamps\CleanMenu\Api\IsAllowedInterface;

class Data extends StructureData
{
    /**
     * @var IsAllowedInterface
     */
    private $isAllowed;

    public function __construct(
        Reader $reader,
        ScopeInterface $configScope,
        CacheInterface $cache,
        string $cacheId,
        SerializerInterface $serializer,
        IsAllowedInterface $isAllowed
    ) {
        $this->isAllowed = $isAllowed;
        parent::__construct($reader, $configScope, $cache, $cacheId, $serializer);
    }

    public function get($path = null, $default = null)
    {
        $data = parent::get($path, $default);

        if (isset($data['tabs'], $data['sections'])) {
            foreach ($data['sections'] as $sectionId => $section) {
                $sectionTab = $section['tab'] ?? '';
                if ($sectionTab && !$this->isAllowed->isAllowed($sectionTab)) {
                    $data['sections'][$sectionId]['tab'] = 'extensions_list';

                    if (isset($data['tabs'][$sectionTab])) {
                        $data['sections'][$sectionId]['tab_original'] = $data['tabs'][$sectionTab];
                        unset($data['tabs'][$sectionTab]);
                    }
                }
            }
        }

        return $data;
    }
}
