<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Model;

use Cepd\PokemonIntegration\Api\Data\PokemonInfoInterface;
use Cepd\PokemonIntegration\Api\PokemonApiInterface;
use Cepd\PokemonIntegration\Api\PokemonInfoRepositoryInterface;
use Cepd\PokemonIntegration\Api\PokemonManagementInterface;
use Cepd\PokemonIntegration\Model\Data\PokemonInfoFactory;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Magento\Framework\App\ResourceConnection;
use Monolog\Logger;

class PokemonManagement implements PokemonManagementInterface
{
    private Config $config;

    private PokemonApiInterface $pokemonApi;

    private Logger $logger;

    private PokemonInfoRepositoryInterface $pokemonInfoRepository;

    private PokemonInfoFactory $pokemonInfoFactory;

    private ResourceConnection $resourceConnection;

    /**
     * @param Config $config
     * @param PokemonApiInterface $pokemonApi
     * @param PokemonInfoRepositoryInterface $pokemonInfoRepository
     * @param PokemonInfoFactory $pokemonInfoFactory
     * @param Logger $logger
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        Config $config,
        PokemonApiInterface $pokemonApi,
        PokemonInfoRepositoryInterface $pokemonInfoRepository,
        PokemonInfoFactory $pokemonInfoFactory,
        Logger $logger,
        ResourceConnection $resourceConnection
    ) {
        $this->config = $config;
        $this->pokemonApi = $pokemonApi;
        $this->logger = $logger;
        $this->pokemonInfoRepository = $pokemonInfoRepository;
        $this->pokemonInfoFactory = $pokemonInfoFactory;
        $this->resourceConnection = $resourceConnection;
    }

    public function getFullImport(): bool
    {
        $result = false;

        if (!$this->config->isEnabled()) {
            return $result;
        }

        try {
            $response = $this->pokemonApi->getCompleteData();
            $responseArray = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
            $pokemonData = $responseArray['data']['pokemon_v2_pokemonspecies'] ?: [];

            if (count($pokemonData) > 0) {
                $this->truncatePokemonTable();
                $dataToInsert = [];

                foreach ($pokemonData as $record) {
                    preg_match('/"front_default"\s*:\s*"([^"]+)"/', json_encode($record), $matches);

                    if (isset($matches[1])) {
                        $data = [
                            'pokemon_id' => $record['id'],
                            'name' => $record['name'],
                            'image_url' => stripslashes($matches[1])
                        ];
                        $dataToInsert[] = $data;
                    }
                }

                if (count($dataToInsert) > 0) {
                    $this->savePoints($dataToInsert);
                    $this->logger->info(sprintf('Successfully saved %s records', count($dataToInsert)));
                }
            }

            $result = true;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
        } catch (GuzzleException $exception) {
            $this->logger->error(sprintf('API Error %s', $exception->getMessage()));
        }

        return $result;
    }

    /**
     * @return void
     */
    private function truncatePokemonTable(): void
    {
        $connection = $this->resourceConnection->getConnection();
        $tableName  = $connection->getTableName(PokemonInfoInterface::TABLE_NAME);
        $connection->truncateTable($tableName);
    }

    /**
     * @param array $data
     *
     * @return void
     */
    private function savePoints(array $data): void
    {
        $connection = $this->resourceConnection->getConnection();
        $connection->insertMultiple($connection->getTableName(PokemonInfoInterface::TABLE_NAME), $data);
    }
}
