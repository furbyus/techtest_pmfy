<?php

namespace Paymefy\Shared\Application\Action;

class BaseCommandHandler implements CommandHandlerInterface
{
    public function handle(CommandInterface $command): int
    {
        return 0;
    }
}
