<?php

namespace MillionsPokemons\DAO;

use Doctrine\DBAL\Connection;
use MillionsPokemons\Domain\TypesPokemons;

class TypesPokemonsDAO extends DAO
{
    
    /**
     * @var \MillionsPokemons\DAO\PokemonsDAO
     */
    private $pokemonDAO;
    
    /**
     * @var \MillionsPokemons\DAO\TypesDAO
     */
    private $typeDAO;

    public function setPokemonsDAO(PokemonsDAO $pokemonDAO) {
        $this->pokemonDAO = $pokemonDAO;
    }
    
    public function setTypeDAO(TypesDAO $typeDAO) {
        $this->typeDAO = $typeDAO;
    }

    /* TODO : complete the 7th iteration */
    protected function buildDomainObject($row) { }
}