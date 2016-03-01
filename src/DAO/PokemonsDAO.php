<?php

namespace MillionsPokemons\DAO;

use Doctrine\DBAL\Connection;
use MillionsPokemons\Domain\Pokemons;

class PokemonsDAO
{
    /**
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $db;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Connection The database connection object
     */
    public function __construct(Connection $db) {
        $this->db = $db;
    }

    /**
     * Return a list of all pokemons, sorted by name.
     *
     * @return array A list of all pokemons.
     */
    public function findAll() {
        $sql = "select * from Pokemons order by nom_pkm desc";
        $result = $this->db->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $pokemons = array();
        foreach ($result as $row) {
            $pokemonsId = $row['idpkm'];
            $pokemons[$pokemonsId] = $this->buildPokemon($row);
        }
        return $pokemons;
    }

    /**
     * Creates a pokemon object based on a DB row.
     *
     * @param array $row The DB row containing Pokemons data.
     * @return \30MillionsPokemons\Domain\Pokemons
     */
    private function buildPokemon(array $row) {
        $pokemon = new Pokemons();
        $pokemon->setId($row['idpkm']);
        $pokemon->setName($row['nom_pkm']);
        $pokemon->setPrice($row['prix']);
        $pokemon->setStock($row['qteStock']);
        $pokemon->setDescription($row['description']);
        return $pokemon;
    }
}