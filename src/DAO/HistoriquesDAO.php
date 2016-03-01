<?php

namespace MillionsPokemons\DAO;

use Doctrine\DBAL\Connection;
use MillionsPokemons\Domain\Historiques;

class HistoriquesDAO
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
     * Return a list of all purchases of the website, sorted by login of the user.
     *
     * @return array A list of all purchase.
     */
    public function findAll() {
        $sql = "select * from Historiques order by login desc";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $historique = array();
        foreach ($result as $row) {
            $userLogin = $row['login'];
            $historique[$userLogin] = $this->buildHistorique($row);
        }
        return $historique;
    }

    /**
     * Creates a Historique object based on a DB row.
     *
     * @param array $row The DB row containing purchase data.
     * @return \30MillionsPokemons\Domain\Historiques
     */
    private function buildHistorique(array $row) {
        $historique = new Historiques();
        $historique ->setLogin($row['login']);
        $historique ->setIdpkm($row['idpkm']);
        $historique ->setDate($row['dateAchat']);
        $historique ->setQuantity($row['qteAchat']);
        return $historique ;
    }
}