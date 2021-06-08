<?php

namespace Paymefy\Shared\Infrastructure\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Style\SymfonyStyle;

use Paymefy\Shared\Application\Command\CommandInterface;
use Paymefy\Shared\Trait\Validable;
use Paymefy\Shared\Trait\ValidableInterface;
use ReflectionClass;

//TODO customize the Exceptions etc...
//TODO to not need to instantiate and validate the command via Reflection, maybe we can make a CommandBus and let the instantiation be made by injection

class CliCommand extends Command implements ValidableInterface
{
    use Validable;

    protected const COMMAND_CLASS = CommandInterface::class;

    protected static $defaultName = "pmfy";
    protected static $defaultDescription = "The BaseCommand for all commands in pmfy namespace";

    private CliParameters $parameters;

    public function __construct()
    {
        $this->parameters = new CliParameters;
        parent::__construct();
    }

    /**
     * Execute the command logic, to decouple the application logic from the framework, we are making the instantiation of the command via variable methods
     *
     * @param CliParameter   $parameter       The param object with our format
     * @param string|null    $parameterName   If the name of the argument or option must be different from the final Object property name, you can specify it
     *
     * @return void 
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (self::class === static::class) { //If we are the base class, list all comands in the namespace
            $listCommand = $this->getApplication()->find('list');
            $listArguments = [
                'namespace'    => 'pmfy',
                '--format'  => 'txt',
            ];
            return $listCommand->run(new ArrayInput($listArguments), $output);
        }

        foreach ($this->parameters->toArray() as $parameter) {
            $method = "get" . ucfirst($parameter->getType());
            $value = $input->{$method}($parameter->getName());
            $parameter->setValue($value);
        }

        $arrayParameters = $this->parameters->toAssocArray();
        $command = $this
            ->getReflectedCommand()
            ->newInstanceArgs($arrayParameters);
        try {
            $this->validate($command);
        } catch (\Throwable $th) {
            $io = new SymfonyStyle($input, $output);
            $io->error($th->getMessage());
        }

        return $this->handler->handle($command);
    }

    /**
     * Adapter method, to decouple the framework from our application.
     *
     * @param CliParameter   $parameter       The param object with our format
     * @param string|null    $parameterName   If the name of the argument or option must be different from the final Object property name, you can specify it
     *
     * @return void 
     */
    protected function addParameter(CliParameter $parameter, ?string $parameterName = null): void
    {
        $property = $this->parameters->addParameter($parameter, $parameterName);
        $method = "add" . ucfirst($parameter->getType());
        $this->{$method}(
            name: $property->getName(),
            mode: $parameter->isRequired() ? InputArgument::REQUIRED : InputArgument::OPTIONAL,
            description: $parameter->getDescription()
        );
    }

    /**
     * Helper method, to instantiate the command, no matter which one in our application.
     */
    protected function getReflectedCommand(): ReflectionClass
    {
        return new ReflectionClass(static::COMMAND_CLASS);
    }
}
