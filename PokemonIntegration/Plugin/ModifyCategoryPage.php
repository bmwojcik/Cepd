<?php


declare(strict_types=1);

namespace Cepd\PokemonIntegration\Plugin;

use Cepd\PokemonIntegration\Api\Service\GetProductPokemonInfoInterface;
use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Image;
use Magento\Catalog\Model\Product;

class ModifyCategoryPage
{
    private GetProductPokemonInfoInterface $getProductPokemonInfo;

    public function __construct(GetProductPokemonInfoInterface $getProductPokemonInfo)
    {
        $this->getProductPokemonInfo = $getProductPokemonInfo;
    }

    /**
     * @param AbstractProduct $subject
     * @param Image $result
     * @param Product $product
     * @return Image
     */
    public function afterGetImage(AbstractProduct $subject, Image $result, Product $product): Image
    {
        if ($pokemonInfo = $this->getProductPokemonInfo->execute($product)) {
            if ($pokemonInfo->getName() && $pokemonInfo->getImageUrl()) {
                $result->setImageUrl($pokemonInfo->getImageUrl());
                $product->setName($pokemonInfo->getName());
            }
        }

        return $result;
    }
}
