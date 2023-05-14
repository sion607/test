<?php
// tests/Command/CreateUserCommandTest.php
namespace App\Tests\TestConsole;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class testPrices extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('console:count-prices-in-categories');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $commandTester->assertCommandIsSuccessful();

        // the output of the command in the console
        $output = $commandTester->getDisplay();

        $outputMsg = "men's clothing - 204.23
jewelery - 883.98
electronics - 1994.99
women's clothing - 157.72
";
        $this->assertStringContainsString($outputMsg, $output, 'It\'s not correct');
    }
}