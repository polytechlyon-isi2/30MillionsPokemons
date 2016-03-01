<?php

namespace MillionsPokemons\DAO;

use Doctrine\DBAL\Connection;
use MillionsPokemons\Domain\Historiques;

class HistoriquesDAO extends DAO
{
    
     /**
     * @var \MillionsPokemons\DAO\UsersDAO
     */
    private $userDAO;

    public function setUserDAO(UsersDAO $userDAO) {
        $this->userDAO = $userDAO;
    }

    /* TODO : complete the 7th iteration */
    protected function buildDomainObject($row) { }
    
}