<?php

namespace App\Command\User;

use App\Entity\User;
use App\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class CreateConsoleCommand extends Command
{
    const COMMAND_NAME = 'app:user:create';

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
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...')
            ->addArgument('username', InputArgument::OPTIONAL, 'The username of the user.')
            ->addArgument('email', InputArgument::OPTIONAL, 'The email of the user.')
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
        $email = $input->getArgument('email');

        if (!$username) {
            $username = $this->question($input, $output, 'Enter username: ');
        }

        if (!$email) {
            $email = $this->question($input, $output, 'Enter email: ');
        }

        $password = $this->question($input, $output, 'Password: ', true);
        $passwordConfirm = $this->question($input, $output, 'Confirm password: ', true);

        if ($password != $passwordConfirm) {
            $output->writeln('Password don\'t match');

            return;
        }

        $this->userService->create(
            (new User())
            ->setUsername($username)
            ->setPassword($password)
            ->setEmail($email)
        );

        $output->writeln(sprintf('User %s created', $username));
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param string $question
     * @param bool $hidden
     * @return string
     */
    private function question(InputInterface $input, OutputInterface $output, string $question, bool $hidden = false)
    {
        $helper = $this->getHelper('question');
        $question = new Question($question);
        $question->setValidator(function ($value) {
            if (trim($value) == '') {
                throw new \Exception('The value cannot be empty');
            }

            return $value;
        });
        $question->setHidden($hidden);

        return $helper->ask($input, $output, $question);
    }
}
