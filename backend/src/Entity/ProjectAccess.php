<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 * @ORM\Entity(repositoryClass="App\Repository\ProjectAccessRepository")
 * @ORM\Table(name="project_access")
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"project_access:read"}},
 *          "denormalization_context"={"groups"={"project_access:write"}}
 *     }
 * )
 */
class ProjectAccess
{
    const ROLE_OWNER = 'owner';

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     * @Groups({"project_access:read"})
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="projects")
     * @ORM\JoinColumn(name="user_id", onDelete="CASCADE")
     * @Groups({"project_access:read"})
     */
    private $user;

    /**
     * @var Project
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="users")
     * @ORM\JoinColumn(name="project_id", onDelete="CASCADE")
     * @Groups({"project_access:write"})
     */
    private $project;

    /**
     * @var Environment|null
     * @ORM\ManyToOne(targetEntity="Environment", inversedBy="users")
     * @ORM\JoinColumn(name="environment_id", onDelete="CASCADE", nullable=true)
     * @Groups({"project_access:read"})
     */
    private $environment;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     * @Groups({"project_access:read"})
     */
    private $role;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetimetz")
     * @Gedmo\Timestampable(on="create")
     * @Groups({"project_access:read"})
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

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
     * @return Environment|null
     */
    public function getEnvironment(): ?Environment
    {
        return $this->environment;
    }

    /**
     * @param Environment|null $environment
     *
     * @return $this
     */
    public function setEnvironment(?Environment $environment)
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     *
     * @return $this
     */
    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
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
}
