<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\Phrase;
use RedChamps\CleanMenu\Spi\ListInterface;

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

        foreach ($this->list->getList() as $value => $label) {
            $options[] = ['label' => new Phrase($label), 'value' => $value];
        }

        return $options;
    }
}
