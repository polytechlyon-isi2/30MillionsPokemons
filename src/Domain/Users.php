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