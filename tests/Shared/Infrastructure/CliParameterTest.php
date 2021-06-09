<?php

namespace Tests\Shared\Infrastructure\Cli;

use Paymefy\Shared\Infrastructure\Cli\CliParameter;
use PHPUnit\Framework\TestCase;

class CliParameterTest extends TestCase
{
    private const PARAM_NAME = 'param_name';
    private const PARAM_TYPE = 'param_type';
    private const PARAM_REQUIRED = false;
    private const PARAM_DESCRIPTION = 'param_description';
    private const PARAM_VALUE = 'param_value';

    private CliParameter $cliParameter;

    public function setUp(): void
    {
        $this->cliParameter = new CliParameter(
            self::PARAM_NAME,
            self::PARAM_TYPE,
            self::PARAM_REQUIRED,
            self::PARAM_DESCRIPTION,
            self::PARAM_VALUE
        );
    }

    public function testCliParameter(): void
    {
        $this->assertEquals($this->cliParameter->getName(), self::PARAM_NAME);
        $this->assertEquals($this->cliParameter->getType(), self::PARAM_TYPE);
        $this->assertEquals($this->cliParameter->isRequired(), self::PARAM_REQUIRED);
        $this->assertEquals($this->cliParameter->getDescription(), self::PARAM_DESCRIPTION);
        $this->assertEquals($this->cliParameter->getValue(), self::PARAM_VALUE);

        $newValue = "newValue";

        $this->cliParameter->setValue($newValue);

        $this->assertEquals($this->cliParameter->getValue(), $newValue);
    }
}
