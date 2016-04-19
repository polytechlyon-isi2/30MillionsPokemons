<?php

namespace MillionsPokemons\Domain;

class Panier
{

    /**
     * Pokemon
     *
     * @var \MillionsPokemons\Domain\Pokemons
     */
    private $pkm;

    /**
     * User
     *
     * @var \MillionsPokemons\Domain\Users
     */
    private $user;

    /**
     * Quantity
     *
     * @var integer
     */
    private $qte;

    //todo : add date
    //todo : pokemon.name au lieu de pokemon.getName dans twig
    //todo : rename panier as commandeProduit

    public function getPkm() {
        return $this->pkm;
    }

    public function setPkm($pkm) {
        $this->pkm = $pkm;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getQte() {
        return $this->qte;
    }

    public function setQte($qte) {
        $this->qte = $qte;
    }
}