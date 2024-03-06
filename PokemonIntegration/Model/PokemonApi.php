<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Model;

use Cepd\PokemonIntegration\Api\PokemonApiInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Psr7\RequestFactory;
use GuzzleHttp\Psr7\Request;
use Laminas\Http\Request as HttpRequest;
use Psr\Http\Message\ResponseInterface;

class PokemonApi implements PokemonApiInterface
{
    private RequestFactory $requestFactory;

    private ClientFactory $clientFactory;

    private Config $config;

    private Client $client;

    /**
     * @param RequestFactory $requestFactory
     * @param ClientFactory $clientFactory
     * @param Config $config
     */
    public function __construct(
        RequestFactory $requestFactory,
        ClientFactory $clientFactory,
        Config $config
    ) {
        $this->requestFactory = $requestFactory;
        $this->clientFactory  = $clientFactory;
        $this->config         = $config;
        $this->client         = $this->clientFactory->create();
    }

    /** @inheritdoc */
    public function getCompleteData(): ResponseInterface
    {
        $query = <<<GRAPHQL
                query {
                  pokemon_v2_pokemonspecies {
                    id
                    name
                    pokemon_v2_pokemons {
                      pokemon_v2_pokemonsprites {
                        sprites
                      }
                    }
                  }
                }
                GRAPHQL;

        $request = $this->buildRequest($query);

        return $this->client->send($request);
    }

    /**
     * @param string $graphQl
     *
     * @return Request
     */
    private function buildRequest(string $graphQl): Request
    {
        $requestBody = json_encode(['query' => $graphQl]);

        return $this->requestFactory->create(
            [
                'method'  => HttpRequest::METHOD_POST,
                'uri'     => $this->config->getEndpointUrl(),
                'body'    => $requestBody,
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]
        );
    }
}
