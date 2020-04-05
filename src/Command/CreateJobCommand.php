<?php


namespace App\Command;


use App\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateJobCommand extends Command
{
    static protected $defaultName = 'app:create-user-job';
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Creation d\'un utilisateur administrateur');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Creation de  l\'utilisateur job etudiant...',
            ' '
        ]);

        $this->userService->createJob();

        $output->writeln([
            'utilisateur crée :'
        ]);

        return 0;
    }
}