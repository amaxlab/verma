<?php

namespace App\Repository;

use App\Entity\ProjectAccess;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @method ProjectAccess|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectAccess save(ProjectAccess $object)
 * @method ProjectAccess|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectAccess[]    findAll()
 * @method ProjectAccess[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)

 */
class ProjectAccessRepository extends AbstractRepository
{
    /**
     * OrderRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjectAccess::class);
    }
}
