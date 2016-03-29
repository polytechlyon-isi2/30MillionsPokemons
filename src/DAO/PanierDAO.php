<?php

namespace MillionsPokemons\DAO;

use Doctrine\DBAL\Connection;
use MillionsPokemons\Domain\Panier;

class PanierDAO extends DAO
{
    
     /**
     * @var \MillionsPokemons\DAO\Users
     */
    private $userDAO;
    
    /**
     * @var \MillionsPokemons\DAO\Pokemons
     */
    private $pkmDAO;

    public function setUserDAO(UsersDAO $userDAO) {
        $this->userDAO = $userDAO;
    }
    
    public function setPokemonsDAO(PokemonsDAO $pkmDAO) {
        $this->pkmDAO = $pkmDAO;
    }
    
    /**
     * Return a list of all cart's line for a selected user.
     *
     * @param integer $idUser The user.
     * @return array A list of all cart's line refering a pokemon with a quantity (corresponding to a user).
     */
    public function findAllByUser($idUser) {

        $user = $this->userDAO->find($idUser);
        $sql = "select * from Panier where idUser =?";
        $result = $this->getDb()->fetchAll($sql, array($user->getId()));

        $allCartsLine = array();
        foreach ($result as $row) {
            $idpkm = $row['idpkm'];
            $line = $this->buildDomainObject($row);
            $allCartsLine[$idpkm] = $line;
        }
        return $allCartsLine;
    }
    
     protected function buildDomainObject($row) { 
        $panier = new Panier();

        if (array_key_exists('idpkm', $row)) {
            $idpkm = $row['idpkm'];
            $pkm = $this->pkmDAO->find($idpkm);
            $panier->setPkm($pkm);
        }
        
        if (array_key_exists('idUser', $row)) {
            $idUser = $row['idUser'];
            $user = $this->userDAO->find($idUser);
            $panier->setUser($user);
        }
         
         $panier->setQte($row['qte']);
        
        return $panier;
    }
    
}