<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Model\ResourceModel;

use Cepd\PokemonIntegration\Api\Data\PokemonInfoInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PokemonInfo extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PokemonInfoInterface::TABLE_NAME, PokemonInfoInterface::ID);
    }
}
