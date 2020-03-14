<?php

declare(strict_types=1);

namespace TwitterBot\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TwitterBotRestrictionsFixture
 */
class TwitterBotRestrictionsFixture extends TestFixture
{
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
        'created' => [
            'type' => 'datetime',
            'length' => null,
            'precision' => null,
            'null' => false,
            'default' => null,
            'comment' => '作成日時'
        ],
        'created_by' => [
            'type' => 'uuid',
            'length' => null,
            'null' => true,
            'default' => null,
            'comment' => '作成者ID',
            'precision' => null
        ],
        'modified' => [
            'type' => 'datetime',
            'length' => null,
            'precision' => null,
            'null' => false,
            'default' => null,
            'comment' => '更新日時'
        ],
        'modified_by' => [
            'type' => 'uuid',
            'length' => null,
            'null' => true,
            'default' => null,
            'comment' => '更新者ID',
            'precision' => null
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
                'id' => 'ea02e5b3-9af4-4079-b47d-c733f3a43f6d',
                'screen_name' => 'Lorem ipsum dolor sit amet',
                'created' => '2020-02-26 01:12:31',
                'created_by' => '51e2464d-9183-48db-8c96-0cfb03e9cf2d',
                'modified' => '2020-02-26 01:12:31',
                'modified_by' => '77964910-97fa-4045-a75d-b273cc0f94d3',
            ],
        ];
        parent::init();
    }
}
