<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 * @ApiResource(
 *     collectionOperations={"get"={"access_control"="is_granted('ROLE_USERS_GET')"}, "post"},
 *     itemOperations={"get"},
 *     attributes={
 *          "normalization_context"={"groups"={"user:read"}},
 *          "denormalization_context"={"groups"={"user:write"}}
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"email": "exact"})
 */
class User implements UserInterface
{
    const ROLE_USER = 'ROLE_USER';

    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     * @Groups({"user:read"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="username", type="string", length=191, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="191")
     * @Groups({"user:read", "user:write"})
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=191, unique=true)
     * @Assert\Email()
     * @Assert\NotBlank()
     * @Assert\Length(max="191")
     * @Groups({"user:read", "user:write"})
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="salt", type="string", length=50)
     */
    private $salt;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Length(min="4")
     * @Groups({"user:write"})
     */
    private $password;

    /**
     * @var array
     * @ORM\Column(name="roles", type="array")
     * @Groups({"user:read"})
     */
    private $roles = [];

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetimetz")
     * @Gedmo\Timestampable(on="create")
     * @Groups({"user:read"})
     */
    private $createdAt;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default"=true})
     * @Groups({"user:read"})
     */
    private $enabled;

    /**
     * @return null|string
     */
    public function __toString()
    {
        return $this->getUsername();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getSalt(): ?string
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     *
     * @return $this
     */
    public function setSalt(string $salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): ?array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     *
     * @return $this
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return $this
     */
    public function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }
}
