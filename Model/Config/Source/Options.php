<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use RedChamps\CleanMenu\Model\ListInterface;

final class Options implements OptionSourceInterface
{
    /**
     * @var ListInterface
     */
    private $list;

    /**
     * @var string[][]
     */
    private $options;

    public function __construct(
        ListInterface $list
    ) {
        $this->list = $list;
    }

    public function toOptionArray(): array
    {
        return $this->options ?? $this->options = $this->loadOptions();
    }

    private function loadOptions(): array
    {
        $options = [];

        foreach ($this->list->getList() as $item) {
            $options[] = ['label' => $item, 'value' => $item];
        }

        return $options;
    }
}
