<?php

namespace Paymefy\Renewals\Infrastructure\Cli;

use Paymefy\Renewals\Application\Action\GetExpiringRenewalsCommand;
use Paymefy\Renewals\Application\Action\GetExpiringRenewalsHandler;
use Paymefy\Shared\Infrastructure\Cli\CliParameter;
use Paymefy\Shared\Infrastructure\Cli\CliParameters;
use Paymefy\Shared\Infrastructure\Cli\CliCommand;

class GetExpiringRenewals extends CliCommand
{
    protected const COMMAND_CLASS = GetExpiringRenewalsCommand::class;

    protected static $defaultName = "pmfy:get:expiring";

    protected GetExpiringRenewalsCommand $command;
    protected GetExpiringRenewalsHandler $handler;

    public function __construct(GetExpiringRenewalsHandler $handler, CliParameters $attributes)
    {
        $this->handler = $handler;
        $this->attributes = $attributes;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Get all clients that their renewals Expires soon and exports it to xml, json or database');

        $this->addParameter(
            new CliParameter(
                name: 'format',
                type: CliParameter::TYPE_ARGUMENT,
                description: 'The format to export the data, values can be xml, json or db'
            )
        );
        $this->addParameter(
            new CliParameter(
                name: 'filename',
                type: CliParameter::TYPE_OPTION,
                required: false,
                description: 'Specify the file location and name, if not specified, it will be a random filename inside /var folder'
            )
        );
    }
    
 

}
