<?php

declare(strict_types=1);

namespace Cepd\PokemonIntegration\Api\Data;

interface PokemonInfoInterface
{
    /**
     * String constants for property names
     */
    public const ID = "id";

    public const POKEMON_ID = "pokemon_id";

    public const NAME = "name";

    public const IMAGE_URL = "image_url";

    public const TABLE_NAME = 'cepd_pokemon_info';

    /**
     * Getter for Id.
     *
     * @return int|null
     */
    public function getId(): ?string;

    /**
     * Setter for Id.
     *
     * @param  $id
     *
     * @return void
     */
    public function setId($id): void;

    /**
     * Getter for Name.
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Setter for Name.
     *
     * @param string|null $name
     *
     * @return void
     */
    public function setName(?string $name): void;

    /**
     * Getter for PokemonId.
     *
     * @return string|null
     */
    public function getPokemonId(): ?string;

    /**
     * Setter for PokemonId.
     *
     * @param string|null $pokemonId
     *
     * @return void
     */
    public function setPokemonId(?string $pokemonId): void;

    /**
     * Getter for ImageUrl.
     *
     * @return string|null
     */
    public function getImageUrl(): ?string;

    /**
     * Setter for ImageUrl.
     *
     * @param string|null $imageUrl
     *
     * @return void
     */
    public function setImageUrl(?string $imageUrl): void;
}
