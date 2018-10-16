<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @ORM\Entity(repositoryClass="App\Repository\EnvironmentRepository")
 * @ORM\Table(name="environments")
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"environment:read"}},
 *          "denormalization_context"={"groups"={"environment:write"}}
 *     }
 * )
 */
class Environment
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     * @Groups({"environment:read"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=191, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="191")
     * @Groups({"environment:read", "environment:write"})
     */
    private $name;

    /**
     * @var Project
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="environments")
     * @ORM\JoinColumn(name="project_id", onDelete="CASCADE", nullable=false)
     */
    private $project;

    /**
     * @var ProjectAccess[]
     * @ORM\OneToMany(targetEntity="ProjectAccess", mappedBy="environment")
     */
    private $users;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetimetz")
     * @Gedmo\Timestampable(on="create")
     * @Groups({"environment:read"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetimetz")
     * @Gedmo\Timestampable(on="update")
     * @Groups({"environment:read"})
     */
    private $updatedAt;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default"=true})
     * @Groups({"environment:read"})
     */
    private $enabled;

    /**
     * Environment constructor.
     */
    public function __construct()
    {
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
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     *
     * @return $this
     */
    public function setProject(Project $project)
    {
        $this->project = $project;

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
