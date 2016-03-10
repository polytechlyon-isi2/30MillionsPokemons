<?php

namespace MillionsPokemons\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class Users implements UserInterface
{
    /**
     * User id
     *
     * @var integer
     */
    private $idUser;
    
    /**
     * User login
     *
     * @var string
     */
    private $login;

    /**
     * User password
     *
     * @var string
     */
    private $mdp;

    /**
     * User name
     *
     * @var string
     */
    private $nameUser;

    /**
     * User firstname
     *
     * @var string
     */
    private $firstnameUser;

    /**
     * User adress
     *
     * @var string
     */
    private $adress;

    /**
     * Role.
     * Values : ROLE_USER or ROLE_ADMIN.
     *
     * @var string
     */
    private $role;

    public function getId() {
        return $this->idUser;
    }

    public function setId($id) {
        $this->idUser = $id;
    }

    /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->login;
    }

    public function setUsername($login) {
        $this->login = $login;
    }

    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->mdp;
    }

    public function setPassword($password) {
        $this->mdp = $password;
    }

    public function getName() {
        return $this->nameUser;
    }

    public function setName($name) {
        $this->nameUser = $name;
    }

    public function getFirstname() {
        return $this->firstnameUser;
    }

    public function setFirstname($firstname) {
        $this->firstnameUser = $firstname;
    }

    public function getAdress() {
        return $this->adress;
    }

    public function setAdress($adress) {
        $this->adress = $adress;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
    }

    public function setRole($role) {
        $this->isAdmin = $isAdmin;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
}