<?php

namespace Tests\Shared\Infrastructure\Cli;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpKernel\KernelInterface;

class CliCommandTest extends KernelTestCase
{
    private const COMMAND = 'pmfy';

    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);
        $command = $application->find(static::COMMAND);
        $this->commandTester = new CommandTester($command);
    }

    public function testCliCommandDoesNothingExceptListCommands(): void
    {
        
        $this->commandTester->execute([]);
        $output = $this->commandTester->getDisplay();
        $this->assertStringContainsString('Available commands for the "pmfy" namespace', $output);
        $this->assertStringContainsString('pmfy:get:expiring', $output);
       
    }

    public function TestCliCommandThrowsExceptionWhenReceivingAnyArgument(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->commandTester->execute(['anyArgument'=>'anyValue']);

    }

    protected function tearDown(): void
    {
    }
}
