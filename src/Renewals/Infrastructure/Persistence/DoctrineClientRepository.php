<?php
declare(strict_types=1);

namespace Paymefy\Renewals\Infrastructure\Persistence;

use Paymefy\Renewals\Domain\Model\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }
    
}
