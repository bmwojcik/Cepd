<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Service;

use Cepd\PokemonIntegration\Api\Data\PokemonInfoInterface;
use Cepd\PokemonIntegration\Api\PokemonInfoRepositoryInterface;
use Cepd\PokemonIntegration\Api\Service\GetProductPokemonInfoInterface;
use Cepd\PokemonIntegration\Model\Config;
use Cepd\PokemonIntegration\Setup\Patch\Data\AddPokemonNameProductAttribute;
use Exception;
use Magento\Catalog\Api\Data\ProductInterface;

class GetProductPokemonInfo implements GetProductPokemonInfoInterface
{
    private Config $config;

    private PokemonInfoRepositoryInterface $pokemonInfoRepository;

    /**
     * @param Config $config
     * @param PokemonInfoRepositoryInterface $pokemonInfoRepository
     */
    public function __construct(
        Config $config,
        PokemonInfoRepositoryInterface $pokemonInfoRepository
    ) {
        $this->config = $config;
        $this->pokemonInfoRepository = $pokemonInfoRepository;
    }

    /** @inheritdoc */
    public function execute(ProductInterface $product): ?PokemonInfoInterface
    {
        $pokemonInfo = null;

        if ($this->config->isEnabled()) {
            $pokemonAttribute = $product->getData(AddPokemonNameProductAttribute::ATTRIBUTE_CODE);

            try {
                $pokemonInfo = $this->pokemonInfoRepository->getByPokemonId((string) $pokemonAttribute);
            } catch(Exception $exception) {}
        }

        return $pokemonInfo;
    }
}
