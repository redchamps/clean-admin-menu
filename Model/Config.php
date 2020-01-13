<?php
declare(strict_types=1);

namespace RedChamps\CleanMenu\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use function explode;

final class Config
{
    public const MENU_ID = 'RedChamps_CleanMenu::extensions';

    private const CONFIG_PATH_ALLOWED_MODULES = 'extensions_list_settings/general/allowed_modules';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var string[]
     */
    private $allowedModules;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getAllowedModules(): array
    {
        return $this->allowedModules
            ?? $this->allowedModules = explode(
                ',',
                $this->scopeConfig->getValue(self::CONFIG_PATH_ALLOWED_MODULES) ?? ''
            );
    }
}
