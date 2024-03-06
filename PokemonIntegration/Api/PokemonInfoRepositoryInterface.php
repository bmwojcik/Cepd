<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Api;

use Cepd\PokemonIntegration\Api\Data\PokemonInfoInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PokemonInfoRepositoryInterface
{
    /**
     * Save PokemonInfo data
     *
     * @param PokemonInfoInterface $pokemonInfo
     * @return PokemonInfoInterface
     * @throws CouldNotSaveException
     */
    public function save(PokemonInfoInterface $pokemonInfo): PokemonInfoInterface;

    /**
     * Retrieve PokemonInfo data by ID
     *
     * @param int $pokemonInfoId
     * @return PokemonInfoInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $pokemonInfoId): PokemonInfoInterface;

    /**
     * Retrieve PokemonInfo data by Pokemon ID
     *
     * @param string $pokemonInfoId
     *
     * @return PokemonInfoInterface
     * @throws NoSuchEntityException
     */
    public function getByPokemonId(string $pokemonInfoId): PokemonInfoInterface;

    /**
     * Delete PokemonInfo
     *
     * @param PokemonInfoInterface $pokemonInfo
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(PokemonInfoInterface $pokemonInfo): bool;

    /**
     * Delete PokemonInfo by ID
     *
     * @param int $pokemonInfoId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $pokemonInfoId): bool;
}
