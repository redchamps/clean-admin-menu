<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

final class Rules implements OptionSourceInterface
{
    /**
     * @var string[][]
     */
    private $options;

    public function __construct(
        array $options
    ) {
        $this->options = $options;
    }

    public function toOptionArray(): array
    {
        return $this->options;
    }
}
