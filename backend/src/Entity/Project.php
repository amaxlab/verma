<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 * @ORM\Table(name="projects")
 * @UniqueEntity("name")
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"project:read"}},
 *          "denormalization_context"={"groups"={"project:write"}}
 *     },
 *     itemOperations={
 *           "get"={"normalization_context"={"groups"={"project:read_detail", "environment:read", "project_access:read", "user:read"}}},
 *           "put",
 *           "delete"
 *     }
 * )
 * @ApiFilter(OrderFilter::class, properties={"id", "name", "createdAt", "updatedAt", "enabled"}, arguments={"orderParameterName"="order"})
 */
class Project
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     * @Groups({"project:read", "project:read_detail"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=191, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="191")
     * @Groups({"project:read", "project:write", "project:read_detail"})
     */
    private $name;

    /**
     * @var Environment[]
     * @ORM\OneToMany(targetEntity="Environment", mappedBy="project")
     * @Groups({"project:read_detail"})
     */
    private $environments;

    /**
     * @var Component[]
     * @ORM\OneToMany(targetEntity="Component", mappedBy="project")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"project:read_detail"})
     */
    private $components;

    /**
     * @var ProjectAccess[]
     * @ORM\OneToMany(targetEntity="ProjectAccess", mappedBy="project")
     * @Groups({"project:read_detail"})
     * @ApiSubresource(maxDepth=1)
     * @MaxDepth(1)
     */
    private $users;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetimetz")
     * @Gedmo\Timestampable(on="create")
     * @Groups({"project:read", "project:read_detail"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetimetz")
     * @Gedmo\Timestampable(on="update")
     * @Groups({"project:read", "project:read_detail"})
     */
    private $updatedAt;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default"=true})
     * @Groups({"project:read", "project:write", "project:read_detail"})
     */
    private $enabled;

    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->environments = new ArrayCollection();
        $this->components = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    /**
     * @return null|string
     */
    public function __toString()
    {
        return $this->getName();
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

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
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

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

    /**
     * @return Environment[]
     */
    public function getEnvironments()
    {
        return $this->environments;
    }

    /**
     * @param Environment[] $environments
     *
     * @return $this
     */
    public function setEnvironments($environments)
    {
        $this->environments = $environments;

        return $this;
    }

    /**
     * @return Component[]
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @param Component[] $components
     *
     * @return $this
     */
    public function setComponents($components)
    {
        $this->components = $components;

        return $this;
    }

    /**
     * @return ProjectAccess[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param ProjectAccess[] $users
     *
     * @return $this
     */
    public function setUsers($users)
    {
        $this->users = $users;

        return $this;
    }
}
