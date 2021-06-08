<?php

namespace Paymefy\Renewals\Application\Action;

use Paymefy\Shared\Application\Action\BaseCommandHandler;
use Paymefy\Shared\Application\Action\CommandInterface;
use Paymefy\Renewals\Application\Task\GetExpiringRenewals;
use Paymefy\Renewals\Application\Task\ExportExpiringRenewalsToDatabase;
use Paymefy\Renewals\Application\Task\ExportExpiringRenewalsToJson;
use Paymefy\Renewals\Application\Task\ExportExpiringRenewalsToXml;
use Symfony\Component\Console\Output\OutputInterface;

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
        ExportExpiringRenewalsToXml $exportToXml,
    ) {
        $this->getClientsTask = $getClientsTask;
        $this->exportToDb = $exportToDb;
        $this->exportToJson = $exportToJson;
        $this->exportToXml = $exportToXml;
    }

    public function handle(CommandInterface $command, OutputInterface $output): void
    {
        $this->command = $command;
        try {
            $clients = $this->getClientsTask->run();
            $exportTask = $this->{'exportTo' . ucfirst($this->command->getFormat())};
            $result = $exportTask->run($clients, $this->command->getFilename());
            
            $output->writeln("Total of " . count($clients) . " clients processed!");
            switch ($this->command->getFormat()) {
                case 'xml':
                case 'json':
                    $output->writeln("Exported the records to file " . $result[0]);
                    break;
                case 'db':
                    $output->writeln("Exported the records to Database");
                    break;
                default:
                    break;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
