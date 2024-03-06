<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Model\ResourceModel\PokemonInfo;

use Cepd\PokemonIntegration\Api\Data\PokemonInfoInterface;
use Cepd\PokemonIntegration\Model\Data\PokemonInfo;
use Cepd\PokemonIntegration\Model\ResourceModel\PokemonInfo as PokemonInfoResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /** {@inheritDoc} */
    public $_idFieldName = PokemonInfoInterface::ID;

    /** {@inheritDoc} */
    protected function _construct()
    {
        $this->_init(PokemonInfo::class, PokemonInfoResource::class);
    }
}
