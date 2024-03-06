<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Api\Service;

use Cepd\PokemonIntegration\Api\Data\PokemonInfoInterface;
use Magento\Catalog\Api\Data\ProductInterface;

interface GetProductPokemonInfoInterface
{
    /**
     * @param ProductInterface $product
     *
     * @return PokemonInfoInterface|null
     */
    public function execute(ProductInterface $product): ?PokemonInfoInterface;
}
