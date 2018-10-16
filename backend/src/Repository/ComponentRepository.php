<?php

namespace App\Repository;

use App\Entity\Component;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @method Component|null find($id, $lockMode = null, $lockVersion = null)
 * @method Component save(Component $object)
 * @method Component|null findOneBy(array $criteria, array $orderBy = null)
 * @method Component[]    findAll()
 * @method Component[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)

 */
class ComponentRepository extends AbstractRepository
{
    /**
     * OrderRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Component::class);
    }
}
