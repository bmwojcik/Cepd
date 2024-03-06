<?php


declare(strict_types=1);

namespace Cepd\PokemonIntegration\Observer;

use Cepd\PokemonIntegration\Api\Service\GetProductPokemonInfoInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ModifyProductPage implements ObserverInterface
{
    private GetProductPokemonInfoInterface $getProductPokemonInfo;

    /**
     * @param GetProductPokemonInfoInterface $getProductPokemonInfo
     */
    public function __construct(GetProductPokemonInfoInterface $getProductPokemonInfo)
    {
        $this->getProductPokemonInfo = $getProductPokemonInfo;
    }

    /** @inheritdoc */
    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();

        if ($pokemonInfo = $this->getProductPokemonInfo->execute($product)) {
            $product->setName($pokemonInfo->getName());
        }

        return $this;
    }
}
