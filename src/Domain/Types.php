<?php

namespace MillionsPokemons\Domain;

class Types
{

    /**
     * Type code
     *
     * @var string
     */
    private $codeType;

    /**
     * Type
     *
     * @var string
     */
    private $type;

    public function getCodeType() {
        return $this->codeType;
    }

    public function setCodeType($code) {
        $this->codeType = $code;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
}