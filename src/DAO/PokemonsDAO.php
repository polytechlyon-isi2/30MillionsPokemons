<?php

namespace MillionsPokemons\DAO;

use Doctrine\DBAL\Connection;
use MillionsPokemons\Domain\Pokemons;

class PokemonsDAO extends DAO
{

    /**
     * Return a list of all pokemons, sorted by name.
     *
     * @return array A list of all pokemons.
     */
    public function findAll() {
        $sql = "select * from Pokemons order by nom_pkm desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $pokemons = array();
        foreach ($result as $row) {
            $pokemonsId = $row['idpkm'];
            $pokemons[$pokemonsId] = $this->buildDomainObject($row);
        }
        return $pokemons;
    }

    /**
     * Returns a pokemon matching the supplied id.
     *
     * @param integer $id
     *
     * @return \MillionsPokemons\Domain\Pokemons|throws an exception if no matching type is found
     */
    public function find($id) {
        $sql = "select * from Pokemons where idpkm=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No Pokemon matching id : " . $id);
    }

    /**
     * Update the pokemon.
     *
     * @param \MillionsPokemons\Domain\Pokemons $pkm The pokemon to update
     */
    public function update(Pokemons $pkm) {

        $pokemonData = array(
            'idpkm' => $pkm->getId(),
            'nom_pkm' => $pkm->getName(),
            'prix' => $pkm->getPrice(),
            'qteStock' => $pkm->getStock(),
            'description' => $pkm->getDescription()
        ); 

        $this->getDb()->update('Pokemons', $pokemonData, array('idpkm' => $pkm->getId()));
    }

    /**
     * Creates a pokemon object based on a DB row.
     *
     * @param array $row The DB row containing Pokemons data.
     * @return \MillionsPokemons\Domain\Pokemons
     */
    protected function buildDomainObject($row) {
        $pokemon = new Pokemons();
        $pokemon->setId($row['idpkm']);
        $pokemon->setName($row['nom_pkm']);
        $pokemon->setPrice($row['prix']);
        $pokemon->setStock($row['qteStock']);
        $pokemon->setDescription($row['description']);
        return $pokemon;
    }
}