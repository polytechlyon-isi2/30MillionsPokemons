<?php

namespace MillionsPokemons\Domain;

class TypesPokemons
{

    /**
     * Pokemon
     *
     * @var \MillionsPokemons\Domain\Pokemons
     */
    private $pkm;

    /**
     * Type
     *
     * @var \MillionsPokemons\Domain\Types
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