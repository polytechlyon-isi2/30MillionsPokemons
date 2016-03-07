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
    
    /**
     * Return a list of all pokemons for a selected Type.
     *
     * @param string $codeType The code type.
     * @return array A list of all pokemons corresponding to the code type.
     */
    public function findAllByType($codeType) {

        //TODO method find in Type.DAO
        $type = $this->typeDAO->find($codeType);

        $sql = "select * from Pokemons p 
                            JOIN TypesPokemons t ON t.idpkm = p.idpkm 
                            where t.codeType=? order by p.nom_pkm";
        $result = $this->getDb()->fetchAll($sql, array($codeType));

        $allPokemons = array();
        foreach ($result as $row) {
            $idpkm = $row['idpkm'];
            $aPokemon = $this->$pokemonDAO->buildDomainObject($row);
            $allPokemons [$idpkm] = $aPokemon;
        }
        return $allPokemons;
    }

    protected function buildDomainObject($row) { 
       //TODO
    }
}