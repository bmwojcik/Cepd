<?php


declare(strict_types=1);

namespace Cepd\PokemonIntegration\Plugin;

use Cepd\PokemonIntegration\Api\Service\GetProductPokemonInfoInterface;
use Magento\Catalog\Block\Product\View\Gallery;
use Magento\Framework\DataObject;

class AddPokemonImage
{
    private GetProductPokemonInfoInterface $getProductPokemonInfo;

    /**
     * @param GetProductPokemonInfoInterface $getProductPokemonInfo
     */
    public function __construct(GetProductPokemonInfoInterface $getProductPokemonInfo)
    {
        $this->getProductPokemonInfo = $getProductPokemonInfo;
    }

    /**
     * @param Gallery $subject
     * @param bool $result
     * @param DataObject $image
     * @return bool
     */
    public function afterIsMainImage(Gallery $subject, bool $result,DataObject $image): bool
    {
        if ($pokemonInfo = $this->getProductPokemonInfo->execute($subject->getProduct())) {
            $image->setLargeImageUrl($pokemonInfo->getImageUrl());
            $image->setUrl($pokemonInfo->getImageUrl());
        }

        return $result;
    }
}
