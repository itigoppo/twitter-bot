<?php

declare(strict_types=1);

namespace TwitterBot\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use TwitterBot\Model\Table\TwitterBotReplyContinuousTable;

/**
 * TwitterBot\Model\Table\TwitterBotReplyContinuousTable Test Case
 */
class TwitterBotReplyContinuousTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \TwitterBot\Model\Table\TwitterBotReplyContinuousTable
     */
    protected $TwitterBotReplyContinuous;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TwitterBotReplyContinuous',
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
            'TwitterBotReplyContinuous'
        ) ? [] : ['className' => TwitterBotReplyContinuousTable::class];
        $this->TwitterBotReplyContinuous = TableRegistry::getTableLocator()->get('TwitterBotReplyContinuous', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TwitterBotReplyContinuous);

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
