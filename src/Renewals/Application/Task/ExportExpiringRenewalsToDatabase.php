<?php

namespace Paymefy\Renewals\Application\Task;

use Paymefy\Renewals\Infrastructure\Persistence\DoctrineClientRepository;
use Doctrine\ORM\EntityManagerInterface;

class ExportExpiringRenewalsToDatabase 
{
    private DoctrineClientRepository $clientRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, DoctrineClientRepository $doctrineClientRepository)
    {
        $this->entityManager = $entityManager;
        $this->clientRepository = $doctrineClientRepository;
    }

    public function run(array $clientsToExport): void
    {
        foreach ($clientsToExport as $client) {
            //TODO see if in the repo already exists a record with the same information. Need to know what fields has to be unique for this
            $this->entityManager->persist($client);
            $this->entityManager->flush();
        }
    }
}
