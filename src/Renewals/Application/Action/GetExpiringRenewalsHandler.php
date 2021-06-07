<?php

namespace Paymefy\Renewals\Application\Action;

use Paymefy\Renewals\Domain\Model\Client;
use Paymefy\Shared\Application\Action\CommandHandlerInterface;

class GetExpiringRenewalsHandler implements CommandHandlerInterface
{
    private GetExpiringRenewalsCommand $command;

    public function __construct(GetExpiringRenewalsCommand $command)
    {
        $this->command = $command;
    }
    public function handle(): int
    {
       $client = new Client;
       dump($client);
       return 0;
    }
}
