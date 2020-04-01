<?php

namespace App\Command;

use App\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateAdminCommand extends Command
{
    static protected $defaultName = 'app:create-admin';
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Creation d\'un utilisateur administrateur');
        $this->addArgument('nom', InputArgument::REQUIRED, 'nom');
        $this->addArgument('prenom', InputArgument::REQUIRED, 'Prenom');
        $this->addArgument('mail', InputArgument::REQUIRED, 'Email');
        $this->addArgument('password', InputArgument::REQUIRED, 'password');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Creation d\'un nouvel administrateur...',
            ' '
        ]);

        $this->userService->createAdmin($input->getArgument('nom'), $input->getArgument('prenom'), $input->getArgument('mail'), $input->getArgument('password'));

        $output->writeln([
            'Administrateur crée :'
        ]);
        $output->writeln([
            'nom: '.$input->getArgument('nom'),
            'prenom: '.$input->getArgument('prenom'),
            'mail: '.$input->getArgument('mail'),
            'password: '.$input->getArgument('password'),
        ]);

        return 0;
    }
}
