<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'workshop',
    description: 'Workshop sandbox command',
)]
class WorkshopCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // TODO: write code here

        return Command::SUCCESS;
    }
}
