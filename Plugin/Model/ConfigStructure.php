<?php
namespace RedChamps\CleanMenu\Plugin\Model;

use Magento\Config\Model\Config\ScopeDefiner;
use Magento\Config\Model\Config\Structure;
use Magento\Config\Model\Config\Structure\Data;
use Magento\Config\Model\Config\Structure\Element\Iterator\Tab;

class ConfigStructure
{
    protected $_coreTabs = [
        "general",
        "catalog",
        "customer",
        "sales",
        "advanced",
        "service",
        "security",
        "yotpo",
        "ddg_automation"
    ];

    protected $_thirdPartyTabs = [];

    /**
     * Config tab iterator
     *
     * @var Tab
     */
    protected $_tabIterator;

    protected $_scopeDefiner;

    public function __construct(
        Data $structureData,
        Tab $tabIterator,
        ScopeDefiner $scopeDefiner
    ) {
        $this->_data = $structureData->get();
        $this->_tabIterator = $tabIterator;
        $this->_scopeDefiner = $scopeDefiner;
    }

    public function aroundGetTabs(Structure $subject, callable $proceed)
    {
        if (isset($this->_data['sections'])) {
            foreach ($this->_data['sections'] as $sectionId => $section) {
                if (isset($section['tab']) && $section['tab']) {
                    if (!in_array($section['tab'], $this->_coreTabs)) {
                        $this->_thirdPartyTabs[$section['tab']][$sectionId] = $section;
                    } else {
                        $this->_data['tabs'][$section['tab']]['children'][$sectionId] = $section;
                    }
                }
            }
            foreach ($this->_thirdPartyTabs as $tabId => $sections) {
                $titleAdded = false;
                foreach ($sections as $section) {
                    if (!$titleAdded) {
                        $section['tab_original'] = $this->_data['tabs'][$section['tab']];
                    }
                    $titleAdded= true;
                    $this->_data['tabs']['extensions_list']['children'][$section['id']] = $section;
                }
            }
            $this->_tabIterator->setElements($this->_data['tabs'], $this->_scopeDefiner->getScope());
        }
        return $this->_tabIterator;
    }
}
