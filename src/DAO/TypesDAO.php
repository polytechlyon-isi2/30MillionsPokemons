<?php

namespace 30MillionsPokemons\DAO;

use Doctrine\DBAL\Connection;
use 30MillionsPokemons\Domain\Types;

class TypesDAO
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
     * Return a list of all types, sorted by pokemon id.
     *
     * @return array A list of all types.
     */
    public function findAll() {
        $sql = "select * from Types order by idpkm desc";
        $result = $this->db->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $types = array();
        foreach ($result as $row) {
            $pokemonId = $row['idpkm'];
            $types[$pokemonId] = $this->buildTypes($row);
        }
        return $types;
    }

    /**
     * Creates a type object based on a DB row.
     *
     * @param array $row The DB row containing Types data.
     * @return \30MillionsPokemons\Domain\Types
     */
    private function buildTypes(array $row) {
        $type = new Types();
        $type->setIdpkm($row['idpkm']);
        $type->setType($row['type']);
        return $pokemon;
    }
}