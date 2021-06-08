<?php

namespace Paymefy\Shared\Application\Action;

use Symfony\Component\Console\Output\OutputInterface;

class BaseCommandHandler implements CommandHandlerInterface
{
    public function handle(CommandInterface $command, OutputInterface $output): void
    {
    }
}
