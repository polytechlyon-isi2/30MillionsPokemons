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
     * User username. It's an adress mail.
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
    private $name;

    /**
     * User firstname
     *
     * @var string
     */
    private $firstname;

    /**
     * User adress
     *
     * @var string
     */
    private $adress;

    /**
     * User postCode
     *
     * @var string
     */
    private $postCode;

    /**
     * Salt that was originally used to encode the password.
     *
     * @var string
     */
    private $salt;

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

    public function setUsername($username) {
        $this->login = $username;
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
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function getAdress() {
        return $this->adress;
    }

    public function setAdress($adress) {
        $this->adress = $adress;
    }

    public function getPostCode() {
        return $this->postCode;
    }

    public function setPostCode($postCode) {
        $this->postCode = $postCode;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
}