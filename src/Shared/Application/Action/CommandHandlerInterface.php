<?php

namespace Paymefy\Shared\Application\Action;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $command): int;
}