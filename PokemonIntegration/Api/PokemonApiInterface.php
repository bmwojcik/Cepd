<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Api;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;

interface PokemonApiInterface
{
    /**
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getCompleteData(): ResponseInterface;
}
