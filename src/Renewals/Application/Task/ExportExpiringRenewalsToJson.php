<?php

namespace Paymefy\Renewals\Application\Task;

use Paymefy\Shared\Application\Task\ExportContentsToFile;

class ExportExpiringRenewalsToJson
{
    private ExportContentsToFile $exportTask;

    public function __construct(ExportContentsToFile $exportContentsToFile)
    {
        $this->exportTask = $exportContentsToFile;
    }

    public function run(array $clientsToExport, ?string $filename): array
    {
        $jsonClients = json_encode($clientsToExport);
        
        $filePath = $this->exportTask->run($jsonClients, $filename, "json");

        return [$filePath, $jsonClients];
    }
}
