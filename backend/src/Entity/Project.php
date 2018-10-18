<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
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
     * @Groups({"project:read"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=191, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="191")
     * @Groups({"project:read", "project:write"})
     */
    private $name;

    /**
     * @var Environment[]
     * @ORM\OneToMany(targetEntity="Environment", mappedBy="project")
     */
    private $environments;

    /**
     * @var Component[]
     * @ORM\OneToMany(targetEntity="Component", mappedBy="project")
     */
    private $components;

    /**
     * @var ProjectAccess[]
     * @ORM\OneToMany(targetEntity="ProjectAccess", mappedBy="project")
     */
    private $users;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetimetz")
     * @Gedmo\Timestampable(on="create")
     * @Groups({"project:read"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetimetz")
     * @Gedmo\Timestampable(on="update")
     * @Groups({"project:read"})
     */
    private $updatedAt;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default"=true})
     * @Groups({"project:read", "project:write"})
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
}
