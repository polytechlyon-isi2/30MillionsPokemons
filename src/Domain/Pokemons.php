<?php

namespace MillionsPokemons\Domain;

class Pokemons 
{
    /**
     * Pokemon id.
     *
     * @var integer
     */
    private $idpkm;

    /**
     * Pokemon name
     *
     * @var string
     */
    private $namepkm;

    /**
     * Pokemon price
     *
     * @var double
     */
    private $pricepkm;

    /**
     * Pokemon stock
     *
     * @var integer
     */
    private $qteStockpkm;

    /**
     * Pokemon description
     *
     * @var string
     */
    private $descriptionpkm;


    public function getId() {
        return $this->idpkm;
    }

    public function setId($id) {
        $this->idpkm = $id;
    }

    public function getName() {
        return $this->namepkm;
    }

    public function setName($name) {
        $this->namepkm = $name;
    }

    public function getPrice() {
        return $this->pricepkm;
    }

    public function setPrice($price) {
        $this->pricepkm = $price;
    }

    public function getStock() {
        return $this->qteStockpkm;
    }

    public function setStock($stock) {
        $this->qteStockpkm = $stock;
    }

    public function getDescription() {
        return $this->descriptionpkm;
    }

    public function setDescription($description) {
        $this->descriptionpkm = $description;
    }
}