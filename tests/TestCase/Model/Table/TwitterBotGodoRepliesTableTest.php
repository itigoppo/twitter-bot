<?php

declare(strict_types=1);

namespace TwitterBot\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use TwitterBot\Model\Table\TwitterBotGodoRepliesTable;

/**
 * TwitterBot\Model\Table\TwitterBotGodoRepliesTable Test Case
 */
class TwitterBotGodoRepliesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \TwitterBot\Model\Table\TwitterBotGodoRepliesTable
     */
    protected $TwitterBotGodoReplies;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TwitterBotGodoReplies',
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
            'TwitterBotGodoReplies'
        ) ? [] : ['className' => TwitterBotGodoRepliesTable::class];
        $this->TwitterBotGodoReplies = TableRegistry::getTableLocator()->get('TwitterBotGodoReplies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TwitterBotGodoReplies);

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
