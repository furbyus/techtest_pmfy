<?php

namespace Paymefy\Renewals\Application\Task;

use Paymefy\Renewals\Domain\Model\Client;
use Paymefy\Shared\Application\Service\FileReader;
use SimpleXMLElement;

use Throwable;

class GetExpiringRenewalsFromXml
{
    private const SOURCE_FILE_NAME = 'public/uploads/data.xml';

    private FileReader $fileReader;

    public function __construct(FileReader $fileReader)
    {
        $this->fileReader = $fileReader;
    }

    public function run(): array
    {

        $fileContents = $this->fileReader->getContents(static::SOURCE_FILE_NAME);
        $clientsToSave = [];

        try {

            $clientsFromXml = new SimpleXMLElement($fileContents);
            $readings = $clientsFromXml->children();

            foreach ($readings as $reading) {
                $client = new Client;
                $client
                    ->setCompany($reading->attributes()->company)
                    ->setName($reading->attributes()->name)
                    ->setPhone($reading->attributes()->phone)
                    ->setEmail($reading[0]);
                $clientsToSave[] = $client;
            }
        } catch (Throwable $th) {
            throw $th;
        }

        return $clientsToSave;
    }
}
