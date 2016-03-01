<?php

namespace MillionsPokemons\DAO;

use Doctrine\DBAL\Connection;
use MillionsPokemons\Domain\Types;

class TypesDAO extends DAO
{
    
    /**
     * Return a list of all category, sorted by name.
     *
     * @return array A list of all types.
     */
    public function findAll() {
        $sql = "select * from Types order by type";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $types = array();
        foreach ($result as $row) {
            $codeType = $row['codeType'];
            $types[$codeType] = $this->buildDomainObject($row);
        }
        return $types;
    }

    /**
     * Creates a type object based on a DB row.
     *
     * @param array $row The DB row containing Type data.
     * @return \MillionsPokemons\Domain\Types
     */
    protected function buildDomainObject($row) {
        $type = new Types();
        $type->setCodeType($row['codeType']);
        $type->setType($row['type']);
        return $type;
    }
}