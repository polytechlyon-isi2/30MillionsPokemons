<?php

namespace 30MillionsPokemons\Domain;

class Types
{

    /**
     * Pokemon id
     *
     * @var integer
     */
    private $idpkm;

    /**
     * Pokemon type
     *
     * @var string
     */
    private $type;
    
    public function getIdpkm() {
        return $this->idpkm;
    }

    public function setIdpkm($idpkm) {
        $this->idpkm = $idpkm;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
}