<?php

namespace 30MillionsPokemons\Domain;

class Historiques
{
    /**
     * User login
     *
     * @var string
     */
    private $login;

    /**
     * Pokemon id
     *
     * @var integer
     */
    private $idpkm;

    /**
     * Purchase date
     *
     * @var date
     */
    private $dateAchat;
    
     /**
     * quantity purchase
     *
     * @var integer
     */
    private $qteAchat;
    
    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }
    
    public function getIdpkm() {
        return $this->idpkm;
    }

    public function setIdpkm($idpkm) {
        $this->idpkm = $idpkm;
    }

    public function getDate() {
        return $this->dateAchat;
    }

    public function setDate($date) {
        $this->dateAchat = $date;
    }

    public function getQuantity() {
        return $this->qteAchat;
    }

    public function setQuantity($qte) {
        $this->qteAchat = $qte;
    }
}