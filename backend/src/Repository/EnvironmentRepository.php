<?php

namespace App\Repository;

use App\Entity\Environment;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @method Environment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Environment save(Environment $object)
 * @method Environment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Environment[]    findAll()
 * @method Environment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)

 */
class EnvironmentRepository extends AbstractRepository
{
    /**
     * OrderRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Environment::class);
    }
}
