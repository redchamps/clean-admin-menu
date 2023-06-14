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
            $thirdPartyTabs = [];
            foreach ($data['sections'] as $sectionId => $section) {
                $sectionTab = $section['tab'] ?? '';
                if ($sectionTab && !$this->isAllowed->isAllowed($sectionTab)) {
                    if (isset($data['tabs'][$sectionTab])) {
                        $section['tab_original'] = $data['tabs'][$sectionTab];
                    }
                    $section['tab'] = 'extensions_list';
                    $thirdPartyTabs[$sectionTab][$sectionId] = $section;
                    unset($data['sections'][$sectionId]);
                }
            }
            ksort($thirdPartyTabs);
            foreach ($thirdPartyTabs as $tabName => $sections) {
                usort($sections, [$this, 'sortSections']);
                $thirdPartyTabs[$tabName] = $sections;
            }
            $data['sections'] = array_merge($data['sections'], array_merge(...array_values($thirdPartyTabs)));
        }

        return $data;
    }

    protected function sortSections($a, $b)
    {
        if ((!isset($a['label']) || !isset($b['label'])) || ($a['label'] == $b['label'])) return 0;
        return ($a['label'] < $b['label']) ? -1 : 1;
    }
}
