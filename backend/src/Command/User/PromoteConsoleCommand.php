<?php

namespace App\Command\User;

use App\Exception\UserNotFoundException;
use App\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class PromoteConsoleCommand extends Command
{
    const COMMAND_NAME = 'app:user:promote';

    /**
     * @var UserService
     */
    private $userService;

    /**
     * CreateAdminCommand constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        parent::__construct(null);

        $this->userService = $userService;
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription('Add role to user.')
            ->addArgument('username', InputArgument::REQUIRED, 'The username.')
            ->addArgument('role', InputArgument::REQUIRED, 'The role name.')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');
        $role = $input->getArgument('role');

        try {
            $user = $this->userService->getByUsername($username);
        } catch (UserNotFoundException $e) {
            $output->writeln('<error>User not found</error>');
            return;
        }

        $user->setRoles(array_merge($user->getRoles(), [$role]));
        $this->userService->update($user);

        $output->writeln(sprintf('User %s add role %s', $username, $role));
    }
}
