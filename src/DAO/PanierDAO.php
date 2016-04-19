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
     * Returns a line matching the supplied user and pokemon.
     *
     * @param integer $iduser The user id.
     * @param integer $idpkm The pokemon id
     * @return \MillionsPokemons\Domain\Panier | null if the line is not found
     */
    public function find($iduser, $idpkm) {
        $sql = "select * from Panier where idUser=? AND idPkm=?";
        $row = $this->getDb()->fetchAssoc($sql, array($iduser, $idpkm));

        if ($row)
            return $this->buildDomainObject($row);

        return null;
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
     * Save a line into the database shop_cart.
     *
     * @param \MillionsPokemons\Domain\Panier $line The line to save
     */
    public function save(Panier $line) {

        $matchingLine = $this->find($line->getUser()->getId(), $line->getPkm()->getId());

        if($matchingLine) {

            // The pokemon has already been saved : update the quantity
            $lineData = array(
                'iduser' => $line->getUser()->getId(),
                'idpkm' => $line->getPkm()->getId(),
                'qte' => $matchingLine->getQte() + 1
            );
            $this->getDb()->update('Panier', $lineData, array('idUser' => $line->getUser()->getId(),
                                                              'idPkm' => $line->getPkm()->getId()));
        } else {

            // The pokemon has never been saved in shop_cart for that user : insert it
            $lineData = array(
                'iduser' => $line->getUser()->getId(),
                'idpkm' => $line->getPkm()->getId(),
                'qte' => $line->getQte()
            );
            $this->getDb()->insert('Panier', $lineData);
        }
    }

    /**
     * Removes a line from the shop cart.
     *
     * @param Panier $line The line to delete.
     */
    public function remove(Panier $line) {

        if($line->getQte() > 1) {

            /* Delete just one pokemon of the cart : so update quantity */
            $lineData = array(
                'iduser' => $line->getUser()->getId(),
                'idpkm' => $line->getPkm()->getId(),
                'qte' => $line->getQte() - 1
            );
            $this->getDb()->update('Panier', $lineData, array('idUser' => $line->getUser()->getId(),
                                                              'idPkm' => $line->getPkm()->getId()));
        } else {

            $this->getDb()->delete('Panier', array('idUser' => $line->getUser()->getId(),
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