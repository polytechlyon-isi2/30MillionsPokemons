<?php

namespace MillionsPokemons\Domain;

class Historiques
{
    /**
     * Purchase Id
     *
     * @var integer
     */
    private $historiqueId;
    
    /**
     * User login
     *
     * @var \MillionsPokemons\Domain\Users
     */
    private $user;

    /**
     * Pokemon id
     *
     * @var \MillionsPokemons\Domain\Pokemons
     */
    private $pkm;

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
    
    public function getHistoriqueId() {
        return $this->historiqueId;
    }

    public function setHistoriqueId($id) {
        $this->historiqueId = $id;
    }
    
    
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }
    
    public function getPkm() {
        return $this->pkm;
    }

    public function setPkm($pkm) {
        $this->pkm = $pkm;
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