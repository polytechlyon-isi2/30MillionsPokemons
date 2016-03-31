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

    /**
     * Check if the selected pokemon for the user selected is already in his shop cart
     *
     * @param integer $iduser The user.
     * @param integer $idpkm The pokemon.
     * @return The line selected if found, null otherwise.
     */
    public function isAlreadyThere($iduser, $idpkm) {

        $user = $this->userDAO->find($iduser);
        $pkm = $this->pkmDAO->find($idpkm);
        $sql = "select * from Panier where idUser =? AND idPkm =?";
        $result = $this->getDb()->fetchAll($sql, array($user->getId(), $pkm->getId()));

        if(empty($result)) {
            return null;
        } 

        $matchingLine = array();
        foreach ($result as $row) {
            $idpkm = $row['idpkm'];
            $line = $this->buildDomainObject($row);
            $matchingLine[$idpkm] = $line;
        }

        return $matchingLine;
    }

    /**
     * Save a line into the database shop_cart.
     *
     * @param \MillionsPokemons\Domain\Panier $line The line to save
     */
    public function save(Panier $line) {

        $matchingLine = $this->isAlreadyThere($line->getUser()->getId(), $line->getPkm()->getId());

        if (empty($matchingLine)) {

            // The pokemon has never been saved in shop_cart for that user : insert it
            $lineData = array(
                'iduser' => $line->getUser()->getId(),
                'idpkm' => $line->getPkm()->getId(),
                'qte' => $line->getQte()
            );
            $this->getDb()->insert('Panier', $lineData);

        } else {

            // The pokemon has already been saved : update the quantity
            $lineData = array(
                'iduser' => $line->getUser()->getId(),
                'idpkm' => $line->getPkm()->getId(),
                'qte' => $matchingLine[$line->getPkm()->getId()]->getQte() + 1
            );
            $this->getDb()->update('Panier', $lineData, array('idUser' => $line->getUser()->getId(),
                                                          'idPkm' => $line->getPkm()->getId()));
        }
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