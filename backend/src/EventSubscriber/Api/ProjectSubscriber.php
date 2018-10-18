<?php

namespace App\EventSubscriber\Api;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Project;
use App\Entity\User;
use App\Exception\EntitySaveException;
use App\Service\ProjectAccessService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class ProjectSubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var ProjectAccessService
     */
    private $projectAccessService;

    /**
     * ProjectSubscriber constructor.
     * @param TokenStorageInterface $tokenStorage
     * @param ProjectAccessService $projectAccessService
     */
    public function __construct(TokenStorageInterface $tokenStorage, ProjectAccessService $projectAccessService)
    {
        $this->tokenStorage = $tokenStorage;
        $this->projectAccessService = $projectAccessService;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                ['beforeSave', EventPriorities::PRE_WRITE],
                ['afterSave', EventPriorities::PRE_WRITE],
            ]
        ];
    }

    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function beforeSave(GetResponseForControllerResultEvent $event)
    {
        $project = $event->getControllerResult();

        if (!$project instanceof Project || $event->getRequest()->getMethod() !== Request::METHOD_POST) {
            return;
        }
    }

    /**
     * @param GetResponseForControllerResultEvent $event
     * @throws EntitySaveException
     */
    public function afterSave(GetResponseForControllerResultEvent $event)
    {
        $project = $event->getControllerResult();

        if (!$project instanceof Project || $event->getRequest()->getMethod() !== Request::METHOD_POST) {
            return;
        }

        /** @var User $user */
        $user = $this->tokenStorage->getToken()->getUser();
        $this->projectAccessService->createProjectOwner($project, $user);
    }
}
