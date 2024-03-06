<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Cron;

use Cepd\PokemonIntegration\Api\PokemonManagementInterface;

class ImportPokemonData
{
    private PokemonManagementInterface $pokemonManagement;

    /**
     * @param PokemonManagementInterface $pokemonManagement
     */
    public function __construct(PokemonManagementInterface $pokemonManagement)
    {
        $this->pokemonManagement = $pokemonManagement;
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $this->pokemonManagement->getFullImport();
    }
}
