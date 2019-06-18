<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/4/25
 * Time: 9:43
 */
namespace Acme\TestBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class CreateUserCommand extends Command{
    protected static $defaultName = 'acme:create-user';

    public function configure()
    {
        $this->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...');
        $this->addArgument('username',InputArgument::REQUIRED,'the username of user');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Hello World',
            'Welcome to symfony create user command',
        ]);

        $output->writeln('it is amazing!!!');
        $output->writeln('Username: ' . $input->getArgument('username'));
    }
}