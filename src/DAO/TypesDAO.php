<?php

namespace MillionsPokemons\DAO;

use Doctrine\DBAL\Connection;
use MillionsPokemons\Domain\Types;

class TypesDAO extends DAO
{
    
    /**
     * @var \MillionsPokemons\DAO\PokemonsDAO
     */
    private $pokemonDAO;

    public function setPokemonsDAO(PokemonsDAO $pokemonDAO) {
        $this->pokemonDAO = $pokemonDAO;
    }

    /* TODO : complete the 7th iteration */
    protected function buildDomainObject($row) { }
}