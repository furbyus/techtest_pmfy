<?php

namespace Paymefy\Renewals\Application\Task;

class GetExpiringRenewals
{
    private GetExpiringRenewalsFromXml $getRenewalsFromXml;
    private GetExpiringRenewalsFromPaymefy $getRenewalsFromPaymefy;

    public function __construct(
        GetExpiringRenewalsFromXml $getExpiringRenewalsFromXml,
        GetExpiringRenewalsFromPaymefy $getExpiringRenewalsFromPaymefy,
    ) {
        $this->getRenewalsFromXml = $getExpiringRenewalsFromXml;
        $this->getRenewalsFromPaymefy = $getExpiringRenewalsFromPaymefy;
    }

    public function run(): array
    {
        $clients = array_merge($this->getRenewalsFromXml->run(), $this->getRenewalsFromPaymefy->run());
        return $clients;
    }
}
