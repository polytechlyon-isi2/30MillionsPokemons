<?php

namespace MillionsPokemons\DAO;

use MillionsPokemons\Domain\Users;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;


class UsersDAO extends DAO implements UserProviderInterface
{
    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \MillionsPokemons\Domain\Users|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from Users where idUser=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching id " . $id);
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $sql = "select * from Users where login=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User with the login "%s" not found.', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * Saves a user into the database.
     *
     * @param \MillionsPokemons\Domain\Users $user The user to save
     */
    public function save(Users $user) {
        $userData = array(
            'login' => $user->getUsername(),
            'mdp' => $user->getPassword(),
            'name' => $user->getName(),
            'firstname' => $user->getFirstname(),
            'adress' => $user->getAdress(),
            'postCode' => $user->getPostCode(),
            'salt' => $user->getSalt(),
            'admin' => $user->getRole()
        );

        if ($user->getId()) {
            // The user has already been saved : update it
            $this->getDb()->update('Users', $userData, array('idUser' => $user->getId()));
        } else {
            // The user has never been saved : insert it
            $this->getDb()->insert('Users', $userData);
            // Get the id of the newly created user and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $user->setId($id);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'MillionsPokemons\Domain\Users' === $class;
    }

    /**
     * Creates a User object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \MicroCMS\Domain\User
     */
    protected function buildDomainObject($row) {
        $user = new Users();
        $user->setId($row['idUser']);
        $user->setUsername($row['login']);
        $user->setPassword($row['mdp']);
        $user->setName($row['name']);
        $user->setFirstname($row['firstname']);
        $user->setAdress($row['adress']);
        $user->setPostCode($row['postCode']);
        $user->setSalt($row['salt']);
        $user->setRole($row['admin']);
        return $user;
    }
}