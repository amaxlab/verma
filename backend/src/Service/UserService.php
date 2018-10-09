<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\EntitySaveException;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @param UserRepository $repository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserRepository $repository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @return int
     */
    public function getAllCount(): int
    {
        return $this->repository->count([]);
    }

    /**
     * @param int $id
     * @return User
     */
    public function get(int $id): User
    {
        if (null == $user = $this->repository->find($id)) {
            throw new UserNotFoundException(sprintf('User with id %d not found', $id));
        }

        return $user;
    }

    /**
     * @param string $username
     * @return User
     */
    public function getByUsername(string $username): User
    {
        if (null == $user = $this->repository->getOneByUsername($username)) {
            throw new UserNotFoundException(sprintf('User with username %s not found', $username));
        }

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function create(User $user): User
    {
        return $this->createUserEntity($user->setRoles([User::ROLE_USER]));
    }

    /**
     * @param User $user
     * @return User
     */
    public function update(User $user): User
    {
        return $this->save($user);
    }

    /**
     * @param User $user
     * @param $password
     * @return string
     */
    public function getEncodedPassword(User $user, $password): string
    {
        return $this->passwordEncoder->encodePassword($user, $password);
    }

    /**
     * @return string
     */
    public function genSalt(): string
    {
        return substr(md5(uniqid('', true)), 0, 10);
    }

    /**
     * @param User $user
     * @return User
     * @throws EntitySaveException
     */
    private function createUserEntity(User $user): User
    {
        $user->setSalt($this->genSalt());

        if (!empty($user->getPassword())) {
            $user->setPassword($this->getEncodedPassword($user, $user->getPassword()));
        }

        return $this->save($user);
    }

    /**
     * @param User $user
     * @return User
     * @throws EntitySaveException
     */
    private function save(User $user): User
    {
        $user = $this->repository->save($user);
        $this->repository->flush();

        return $user;
    }
}
