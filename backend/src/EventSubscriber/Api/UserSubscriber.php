<?php

namespace App\EventSubscriber\Api;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use App\Service\UserService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class UserSubscriber implements EventSubscriberInterface
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * WalletSubscriber constructor.
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                ['beforeSave', EventPriorities::PRE_WRITE],
            ]
        ];
    }

    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function beforeSave(GetResponseForControllerResultEvent $event)
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$user instanceof User) {
            return;
        }

        if (Request::METHOD_POST === $method) {
            $user->setSalt($this->userService->genSalt());
            $user->setPassword($this->userService->getEncodedPassword($user, $user->getPassword()));
        }
    }
}
