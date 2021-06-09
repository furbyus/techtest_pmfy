<?php

namespace Tests\Shared\Infrastructure\Cli;

use Paymefy\Shared\Infrastructure\Cli\CliParameter;
use Paymefy\Shared\Infrastructure\Cli\CliParameters;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use Prophecy\Prophecy\ObjectProphecy;

class CliParametersTest extends TestCase
{
    private Prophet $prophet;
    private CliParameter|ObjectProphecy $cliParameter;
    
    public function setUp(): void
    {
        $this->prophet = new Prophet();
        $this->cliParameter = $this->prophet->prophesize(CliParameter::class);
    }

    public function testCliParameters(): void
    {
        $this->cliParameter->getName()
        ->willReturn('testParameterName')
        ->shouldBeCalledOnce();

        $parameters = new CliParameters;
        $parameters->addParameter($this->cliParameter->reveal());
        $parameters->addParameter($this->cliParameter->reveal(), 'newParameterName');

        $this->assertSame($parameters->getParameter('testParameterName'), $this->cliParameter->reveal());
        $this->assertSame($parameters->getParameter('newParameterName'), $this->cliParameter->reveal());

        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        $this->prophet->checkPredictions();
    }
}
