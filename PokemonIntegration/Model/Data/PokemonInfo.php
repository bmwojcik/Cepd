<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Model\Data;

use Cepd\PokemonIntegration\Api\Data\PokemonInfoInterface;
use Cepd\PokemonIntegration\Model\ResourceModel\PokemonInfo as PokemonInfoResource;
use Magento\Framework\Model\AbstractExtensibleModel;

class PokemonInfo extends AbstractExtensibleModel implements PokemonInfoInterface
{
    protected $_eventPrefix = PokemonInfoInterface::TABLE_NAME;

    protected function _construct()
    {
        $this->_init(PokemonInfoResource::class);
    }

    /**
     * @inheritdoc
     */
    public function getId(): ?string
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritdoc
     */
    public function setId($id): void
    {
        $this->setData(self::ID, $id);
    }

    /** @inheritdoc */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /** @inheritdoc */
    public function setName(?string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    /** @inheritdoc */
    public function getPokemonId(): ?string
    {
        return $this->getData(self::POKEMON_ID);
    }

    /** @inheritdoc */
    public function setPokemonId(?string $pokemonId): void
    {
        $this->setData(self::NAME, $pokemonId);
    }

    /** @inheritdoc */
    public function getImageUrl(): ?string
    {
        return $this->getData(self::IMAGE_URL);
    }

    /** @inheritdoc */
    public function setImageUrl(?string $imageUrl): void
    {
        $this->setData(self::IMAGE_URL, $imageUrl);
    }
}
