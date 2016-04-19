<?php

namespace MillionsPokemons\DAO;

use Doctrine\DBAL\Connection;
use MillionsPokemons\Domain\TypesPokemons;

class TypesPokemonsDAO extends DAO
{

    /**
     * @var \MillionsPokemons\DAO\Pokemons
     */
    private $pokemonDAO;

    /**
     * @var \MillionsPokemons\DAO\Types
     */
    private $typeDAO;

    public function setPokemonsDAO(PokemonsDAO $pokemonDAO) {
        $this->pokemonDAO = $pokemonDAO;
    }

    public function setTypeDAO(TypesDAO $typeDAO) {
        $this->typeDAO = $typeDAO;
    }

    /**
     * Return a list of all pokemons for a selected Type.
     *
     * @param string $codeType The code type.
     * @return array A list of all pokemons corresponding to the code type.
     */
    public function findAllByType($codeType) {

        $type = $this->typeDAO->find($codeType);
        $sql = "select * from TypesPokemons t 
                            JOIN Pokemons p ON t.idpkm = p.idpkm 
                            where t.type=? order by p.nom_pkm";
        $result = $this->getDb()->fetchAll($sql, array($type->getCodeType()));

        $allPokemons = array();
        foreach ($result as $row) {
            $idpkm = $row['idpkm'];
            $typePokemon = $this->buildDomainObject($row);
            $allPokemons[$idpkm] = $typePokemon->getPkm();
        }
        return $allPokemons;
    }

    /**
     * Return a list of all types for a selected pokemon.
     *
     * @param integer $idpkm The pokemon.
     * @return array A list of all types corresponding to the pokemon.
     */
    public function findAllByPokemon($idpkm) {

        $pokemons = $this->pokemonDAO->find($idpkm);
        $sql = "select * from TypesPokemons t 
                            JOIN Types tbis ON tbis.codeType = t.type 
                            where t.idpkm=?";
        $result = $this->getDb()->fetchAll($sql, array($pokemons->getId()));

        $allTypes = array();
        foreach ($result as $row) {
            $codeType = $row['codeType'];
            $typePokemon = $this->buildDomainObject($row);
            $allTypes[$codeType] = $typePokemon->getType();
        }
        return $allTypes;
    }

    protected function buildDomainObject($row) { 
        $typePokemon = new TypesPokemons();

        if (array_key_exists('idpkm', $row)) {
            $idpkm = $row['idpkm'];
            $pkm = $this->pokemonDAO->find($idpkm);
            $typePokemon->setPkm($pkm);
        }

        if (array_key_exists('codeType', $row)) {
            $codeType = $row['codeType'];
            $type = $this->typeDAO->find($codeType);
            $typePokemon->setType($type);
        }

        return $typePokemon;
    }
}