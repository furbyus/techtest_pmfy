<?php

namespace Paymefy\Renewals\Application\Task;

use Paymefy\Shared\Application\Task\ExportContentsToFile;
use SimpleXMLElement;

class ExportExpiringRenewalsToXml
{
    private ExportContentsToFile $exportTask;

    public function __construct(ExportContentsToFile $exportContentsToFile)
    {
        $this->exportTask = $exportContentsToFile;
    }

    public function run(array $clientsToExport, ?string $filename): array
    {
        $xml = new SimpleXMLElement('<clientes/>');
        foreach ($clientsToExport as $client) {
           $clientArray = (array) $client->jsonSerialize();
           $clientNode = $xml->addChild('client');
           foreach ($clientArray as $clientProperty => $clientValue) {
                $clientNode->addChild($clientProperty,$clientValue);
           }
        }
        $xmlClients = $xml->asXML();
        $filePath = $this->exportTask->run($xmlClients, $filename, "xml");

        return [$filePath, $xmlClients];
    }
}
