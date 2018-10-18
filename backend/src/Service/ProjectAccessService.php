<?php

namespace App\Service;

use App\Entity\Project;
use App\Entity\ProjectAccess;
use App\Entity\User;
use App\Exception\EntitySaveException;
use App\Repository\ProjectAccessRepository;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class ProjectAccessService
{
    /**
     * @var ProjectAccessRepository
     */
    private $repository;

    /**
     * ProjectService constructor.
     * @param ProjectAccessRepository $repository
     */
    public function __construct(ProjectAccessRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Project $project
     * @param User $user
     * @return ProjectAccess
     * @throws EntitySaveException
     */
    public function createProjectOwner(Project $project, User $user): ProjectAccess
    {
        return $this->repository->save(
            (new ProjectAccess())
                ->setUser($user)
                ->setProject($project)
                ->setRole(ProjectAccess::ROLE_OWNER)
        );
    }
}
