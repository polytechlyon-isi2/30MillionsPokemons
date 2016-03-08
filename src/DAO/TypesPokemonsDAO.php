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

    protected function buildDomainObject($row) { 
        $typePokemon = new TypesPokemons();

        if (array_key_exists('idpkm', $row)) {
            // Find and set the associated pokemon
            $idpkm = $row['idpkm'];
            $pkm = $this->pokemonDAO->find($idpkm);
            $typePokemon->setPkm($pkm);
        }  
        
        return $typePokemon;
    }
}