<?php

namespace LibraUser\Repository;

use Doctrine\ORM\EntityRepository;
use LibraUser\Entity\User as UserEntity;
use ZfcUser\Mapper\UserInterface;

class User extends EntityRepository implements UserInterface
{
    /**
     * @param string $email
     * @return UserEntity
     */
    public function findByEmail($email)
    {
        return $this->findOneBy(array('email' => $email));
    }

    /**
     * @return UserEntity
     */
    public function findByUsername($username)
    {
        return $this->findOneBy(array('username' => $username));
    }

    /**
     * @return UserEntity
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * @return UserEntity
     */
    public function insert($entity)
    {
        return $this->persist($entity);
    }

    /**
     * @return UserEntity
     */
    public function update($entity)
    {
        return $this->persist($entity);
    }

    /**
     * @return UserEntity
     */
    protected function persist($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }
}
