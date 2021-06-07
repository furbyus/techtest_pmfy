<?php

namespace Paymefy\Renewals\Application\Task;

use Paymefy\Renewals\Infrastructure\Persistence\DoctrineClientRepository;
use Paymefy\Shared\Application\Task;

class ExportExpiringRenewalsToDatabase extends Task
{
    private DoctrineClientRepository $clientRepository;

    public function __construct()
    {
        
    }


}