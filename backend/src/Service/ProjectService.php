<?php

namespace App\Service;

use App\Repository\ProjectRepository;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class ProjectService
{
    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * ProjectService constructor.
     * @param ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }
}
