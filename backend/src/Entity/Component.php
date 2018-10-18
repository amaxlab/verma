<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @ORM\Entity(repositoryClass="App\Repository\ComponentRepository")
 * @ORM\Table(name="components")
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"component:read"}},
 *          "denormalization_context"={"groups"={"component:write"}}
 *     }
 * )
 */
class Component
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     * @Groups({"component:read"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=191)
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="191")
     * @Groups({"component:read", "component:write"})
     */
    private $name;

    /**
     * @var Project
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="components")
     * @ORM\JoinColumn(name="project_id", onDelete="CASCADE", nullable=false)
     * @Groups({"component:read", "component:write"})
     */
    private $project;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetimetz")
     * @Gedmo\Timestampable(on="create")
     * @Groups({"component:read"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetimetz")
     * @Gedmo\Timestampable(on="update")
     * @Groups({"component:read"})
     */
    private $updatedAt;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default"=true})
     * @Groups({"component:read", "component:write"})
     */
    private $enabled;

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
