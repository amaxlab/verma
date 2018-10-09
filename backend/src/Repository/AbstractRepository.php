<?php

namespace App\Repository;

use App\Exception\EntitySaveException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
abstract class AbstractRepository extends ServiceEntityRepository
{
    /**
     * @param $entity
     * @return object
     * @throws EntitySaveException
     */
    public function save($entity)
    {
        try {
            $this->getEntityManager()->persist($entity);
        } catch (ORMException $e) {
            throw new EntitySaveException('Error on save entity');
        }

        return $entity;
    }

    /**
     * @throws EntitySaveException
     */
    public function flush()
    {
        try {
            $this->getEntityManager()->flush();
        } catch (ORMException $e) {
            throw new EntitySaveException('Error on flush entity');
        }
    }
}
