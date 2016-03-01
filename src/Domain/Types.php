<?php

namespace MillionsPokemons\Domain;

class Types
{

    /**
     * Pokemon
     *
     * @var \MillionsPokemons\Domain\Pokemons
     */
    private $pkm;

    /**
     * Pokemon type
     *
     * @var string
     */
    private $type;
    
    public function getPkm() {
        return $this->pkm;
    }

    public function setPkm($pkm) {
        $this->pkm = $pkm;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
}