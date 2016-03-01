<?php

namespace MillionsPokemons\Domain;

class Users
{
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
     * User mail
     *
     * @var string
     */
    private $mail;
    
    /**
     * User adress
     *
     * @var string
     */
    private $adress;
    
    /**
     * User is admin if = 1 ; not admin if = 0
     *
     * @var integer
     */
    private $isAdmin;

    
    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }
    
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
    
    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }
    
    public function getAdress() {
        return $this->adress;
    }

    public function setAdress($adress) {
        $this->adress = $adress;
    }
    
    public function getAdminStatus() {
        return $this->isAdmin;
    }

    public function setAdminStatus($isAdmin) {
        $this->isAdmin = $isAdmin;
    }
}