<?php

declare(strict_types=1);

namespace TwitterBot\Test\TestCase\Command;

use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;
use TwitterBot\Command\TwitterBotGodoCommand;

/**
 * TwitterBot\Command\TwitterBotGodoCommand Test Case
 *
 * @uses \TwitterBot\Command\TwitterBotGodoCommand
 */
class TwitterBotGodoCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->useCommandRunner();
    }

    /**
     * Test buildOptionParser method
     *
     * @return void
     */
    public function testBuildOptionParser(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test execute method
     *
     * @return void
     */
    public function testExecute(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
