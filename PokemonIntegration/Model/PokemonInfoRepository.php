<?php

namespace Cepd\PokemonIntegration\Model;

use Cepd\PokemonIntegration\Api\Data\PokemonInfoInterface;
use Cepd\PokemonIntegration\Api\PokemonInfoRepositoryInterface;
use Cepd\PokemonIntegration\Model\Data\PokemonInfoFactory;
use Cepd\PokemonIntegration\Model\ResourceModel\PokemonInfo as PokemonInfoResource;
use Cepd\PokemonIntegration\Model\ResourceModel\PokemonInfo\CollectionFactory as PokemonInfoCollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class PokemonInfoRepository implements PokemonInfoRepositoryInterface
{
    /** @var PokemonInfoInterface[] */
    private array $instances;

    /** @var PokemonInfoInterface[] */
    private array $pokemonIds;

    private PokemonInfoFactory $pokemonInfoFactory;

    private PokemonInfoResource $pokemonInfoResource;

    private PokemonInfoCollectionFactory $pokemonInfoCollectionFactory;

    /**
     * @param PokemonInfoFactory $pokemonInfoFactory
     * @param PokemonInfoResource $pokemonInfoResource
     * @param PokemonInfoCollectionFactory $pokemonInfoCollectionFactory
     */
    public function __construct(
        PokemonInfoFactory $pokemonInfoFactory,
        PokemonInfoResource $pokemonInfoResource,
        PokemonInfoCollectionFactory $pokemonInfoCollectionFactory
    ) {
        $this->pokemonInfoFactory = $pokemonInfoFactory;
        $this->pokemonInfoResource = $pokemonInfoResource;
        $this->pokemonInfoCollectionFactory = $pokemonInfoCollectionFactory;
    }

    /** @inheritdoc */
    public function save(PokemonInfoInterface $pokemonInfo): PokemonInfoInterface
    {
        try {
            $this->pokemonInfoResource->save($pokemonInfo);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $pokemonInfo;
    }

    /** @inheritdoc */
    public function getById(int $pokemonInfoId): PokemonInfoInterface
    {
        if (!isset($this->instances[$pokemonInfoId])) {
            $pokemonInfo = $this->pokemonInfoFactory->create();
            $this->pokemonInfoResource->load($pokemonInfo, $pokemonInfoId);

            if (!$pokemonInfo->getId()) {
                throw new NoSuchEntityException(__('Pokemon with id "%1" does not exist.', $pokemonInfoId));
            }

            $this->instances[$pokemonInfoId] = $pokemonInfo;
        }

        return $this->instances[$pokemonInfoId];
    }

    /** @inheritdoc */
    public function getByPokemonId(string $pokemonInfoId): PokemonInfoInterface
    {
        if (!isset($this->pokemonIds[$pokemonInfoId])) {
            $pokemonInfo = $this->pokemonInfoFactory->create();
            $this->pokemonInfoResource->load($pokemonInfo, $pokemonInfoId, PokemonInfoInterface::POKEMON_ID);

            if (!$pokemonInfo->getId()) {
                throw new NoSuchEntityException(__('Pokemon with id "%1" does not exist.', $pokemonInfoId));
            }

            $this->pokemonIds[$pokemonInfoId] = $pokemonInfo;
        }

        return $this->pokemonIds[$pokemonInfoId];
    }

    /** @inheritdoc */
    public function delete(PokemonInfoInterface $pokemonInfo): bool
    {
        try {
            $this->pokemonInfoResource->delete($pokemonInfo);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /** @inheritdoc */
    public function deleteById($pokemonInfoId): bool
    {
        return $this->delete($this->getById($pokemonInfoId));
    }
}
