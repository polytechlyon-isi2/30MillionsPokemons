<?php

namespace 30MillionsPokemons\DAO;

use Doctrine\DBAL\Connection;
use 30MillionsPokemons\Domain\Users;

class UsersDAO
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
     * Return a list of all users, sorted by name.
     *
     * @return array A list of all users.
     */
    public function findAll() {
        $sql = "select * from Users order by nom desc";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $user = array();
        foreach ($result as $row) {
            $userId = $row['login'];
            $user[$userId] = $this->buildUser($row);
        }
        return $user;
    }

    /**
     * Creates a user object based on a DB row.
     *
     * @param array $row The DB row containing user data.
     * @return \30MillionsPokemons\Domain\Users
     */
    private function buildUser(array $row) {
        $user = new Users();
        $user->setLogin($row['login']);
        $user->setPassword($row['mdp']);
        $user->setName($row['nom']);
        $user->setFirstname($row['prenom']);
        $user->setMail($row['mail']);
        $user->setAdress($row['adresse']);
        $user->setAdminStatus($row['admin']);
        return $user;
    }
}