<?php

namespace MillionsPokemons\DAO;

use Doctrine\DBAL\Connection;
use MillionsPokemons\Domain\Users;

class UsersDAO extends DAO
{
    
    /**
     * Return a list of all users, sorted by name.
     *
     * @return array A list of all users.
     */
    public function findAll() {
        $sql = "select * from Users order by nom desc";
        $result = $this->getDb->fetchAll($sql);

        // Convert query result to an array of domain objects
        $user = array();
        foreach ($result as $row) {
            $userId = $row['login'];
            $user[$userId] = $this->buildDomainObject($row);
        }
        return $user;
    }

    /**
     * Creates a user object based on a DB row.
     *
     * @param array $row The DB row containing user data.
     * @return \30MillionsPokemons\Domain\Users
     */
    protected function buildDomainObject($row) {
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