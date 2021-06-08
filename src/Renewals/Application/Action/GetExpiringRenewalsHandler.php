<?php

namespace Paymefy\Renewals\Application\Action;

use Paymefy\Shared\Application\Action\BaseCommandHandler;
use Paymefy\Shared\Application\Action\CommandInterface;
use Paymefy\Renewals\Application\Task\GetExpiringRenewals;
use Paymefy\Renewals\Application\Task\ExportExpiringRenewalsToDatabase;
use Paymefy\Renewals\Application\Task\ExportExpiringRenewalsToJson;
use Paymefy\Renewals\Application\Task\ExportExpiringRenewalsToXml;

class GetExpiringRenewalsHandler extends BaseCommandHandler
{
    private GetExpiringRenewals $getClientsTask;
    private ExportExpiringRenewalsToDatabase $exportToDb;
    private ExportExpiringRenewalsToJson $exportToJson;
    private ExportExpiringRenewalsToXml $exportToXml;
    private GetExpiringRenewalsCommand $command;

    public function __construct(
        GetExpiringRenewals $getClientsTask,
        ExportExpiringRenewalsToDatabase $exportToDb,
        ExportExpiringRenewalsToJson $exportToJson,
        ExportExpiringRenewalsToXml $exportToXml
    ) {
        $this->getClientsTask = $getClientsTask;
        $this->exportToDb = $exportToDb;
        $this->exportToJson = $exportToJson;
        $this->exportToXml = $exportToXml;
    }

    public function handle(CommandInterface $command): int
    {
        $this->command = $command;
        try {
            $cs = $this->getClientsTask->run();
            $exportTask = $this->{'exportTo' . ucfirst($this->command->getFormat())};
            $exportTask->run($cs, $this->command->getFilename());
        } catch (\Throwable $th) {
            throw $th;
        }
        
        return 0;
    }
}
