<?php

namespace Paymefy\Shared\Application\Action;

use Symfony\Component\Console\Output\OutputInterface;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $command, OutputInterface $output): void;
}