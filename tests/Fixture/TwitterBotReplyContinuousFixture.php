<?php

declare(strict_types=1);

namespace TwitterBot\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TwitterBotReplyContinuousFixture
 */
class TwitterBotReplyContinuousFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'twitter_bot_reply_continuous';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => [
            'type' => 'uuid',
            'length' => null,
            'null' => false,
            'default' => null,
            'comment' => 'ID',
            'precision' => null
        ],
        'screen_name' => [
            'type' => 'string',
            'length' => 50,
            'null' => false,
            'default' => '',
            'collate' => 'utf8mb4_general_ci',
            'comment' => 'ユーザーアカウント名',
            'precision' => null
        ],
        'target_screen_name' => [
            'type' => 'string',
            'length' => 50,
            'null' => false,
            'default' => '',
            'collate' => 'utf8mb4_general_ci',
            'comment' => '対象ユーザーアカウント名',
            'precision' => null
        ],
        'count' => [
            'type' => 'integer',
            'length' => 5,
            'unsigned' => false,
            'null' => false,
            'default' => '0',
            'comment' => '連続数',
            'precision' => null,
            'autoIncrement' => null
        ],
        'created' => [
            'type' => 'datetime',
            'length' => null,
            'precision' => null,
            'null' => false,
            'default' => null,
            'comment' => '作成日時'
        ],
        'modified' => [
            'type' => 'datetime',
            'length' => null,
            'precision' => null,
            'null' => false,
            'default' => null,
            'comment' => '更新日時'
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => '474ef5a6-e470-41ab-b8f3-ee076c4d472d',
                'screen_name' => 'Lorem ipsum dolor sit amet',
                'target_screen_name' => 'Lorem ipsum dolor sit amet',
                'count' => 1,
                'created' => '2020-02-26 01:12:30',
                'modified' => '2020-02-26 01:12:30',
            ],
        ];
        parent::init();
    }
}
