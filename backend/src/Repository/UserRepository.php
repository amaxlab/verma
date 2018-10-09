<?php

namespace App\Repository;

use App\Entity\User;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User save(User $object)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)

 */
class UserRepository extends AbstractRepository
{
    /**
     * OrderRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $username
     * @return User|null
     */
    public function getOneByUsername(string $username): ?User
    {
        return $this->findOneBy(['username' => $username]);
    }
}
