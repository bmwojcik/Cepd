<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    public const POKEMON_API_INTEGRATION_ENABLED = 'cepd_pokemon_api/general/enable';

    public const POKEMON_API_ENDPOINT_URL = 'cepd_pokemon_api/general/endpoint_url';

    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param int|null $websiteId
     *
     * @return bool
     */
    public function isEnabled(?int $websiteId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::POKEMON_API_INTEGRATION_ENABLED,
            ScopeInterface::SCOPE_WEBSITE,
            $websiteId
        );
    }

    /**
     * @param int|null $websiteId
     *
     * @return string
     */
    public function getEndpointUrl(?int $websiteId = null): string
    {
        return (string)$this->scopeConfig->getValue(
            self::POKEMON_API_ENDPOINT_URL,
            ScopeInterface::SCOPE_WEBSITE,
            $websiteId
        );
    }
}
