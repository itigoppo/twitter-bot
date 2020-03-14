<?php

declare(strict_types=1);

namespace TwitterBot\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use TwitterBot\Model\Table\TwitterBotGodoSayingsTable;

/**
 * TwitterBot\Model\Table\TwitterBotGodoSayingsTable Test Case
 */
class TwitterBotGodoSayingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \TwitterBot\Model\Table\TwitterBotGodoSayingsTable
     */
    protected $TwitterBotGodoSayings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TwitterBotGodoSayings',
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
            'TwitterBotGodoSayings'
        ) ? [] : ['className' => TwitterBotGodoSayingsTable::class];
        $this->TwitterBotGodoSayings = TableRegistry::getTableLocator()->get('TwitterBotGodoSayings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TwitterBotGodoSayings);

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
