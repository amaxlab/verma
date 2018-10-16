<?php

namespace App\Repository;

use App\Entity\Project;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project save(Project $object)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)

 */
class ProjectRepository extends AbstractRepository
{
    /**
     * OrderRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Project::class);
    }
}
