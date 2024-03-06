<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Api;

interface PokemonManagementInterface
{
    /**
     * @return bool
     */
    public function getFullImport(): bool;
}
