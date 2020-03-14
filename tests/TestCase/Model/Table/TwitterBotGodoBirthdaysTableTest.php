<?php

declare(strict_types=1);

namespace TwitterBot\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use TwitterBot\Model\Table\TwitterBotGodoBirthdaysTable;

/**
 * TwitterBot\Model\Table\TwitterBotGodoBirthdaysTable Test Case
 */
class TwitterBotGodoBirthdaysTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \TwitterBot\Model\Table\TwitterBotGodoBirthdaysTable
     */
    protected $TwitterBotGodoBirthdays;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TwitterBotGodoBirthdays',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists(
            'TwitterBotGodoBirthdays'
        ) ? [] : ['className' => TwitterBotGodoBirthdaysTable::class];
        $this->TwitterBotGodoBirthdays = TableRegistry::getTableLocator()->get('TwitterBotGodoBirthdays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TwitterBotGodoBirthdays);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
