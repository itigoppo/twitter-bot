<?php

declare(strict_types=1);

namespace TwitterBot\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use TwitterBot\Model\Table\TwitterBotRestrictionsTable;

/**
 * TwitterBot\Model\Table\TwitterBotRestrictionsTable Test Case
 */
class TwitterBotRestrictionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \TwitterBot\Model\Table\TwitterBotRestrictionsTable
     */
    protected $TwitterBotRestrictions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TwitterBotRestrictions',
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
            'TwitterBotRestrictions'
        ) ? [] : ['className' => TwitterBotRestrictionsTable::class];
        $this->TwitterBotRestrictions = TableRegistry::getTableLocator()->get('TwitterBotRestrictions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TwitterBotRestrictions);

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
