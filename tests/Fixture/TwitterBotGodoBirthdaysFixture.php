<?php

declare(strict_types=1);

namespace TwitterBot\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TwitterBotGodoBirthdaysFixture
 */
class TwitterBotGodoBirthdaysFixture extends TestFixture
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
        'name' => [
            'type' => 'string',
            'length' => 50,
            'null' => true,
            'default' => null,
            'collate' => 'utf8mb4_general_ci',
            'comment' => 'ユーザー名',
            'precision' => null
        ],
        'birthday' => [
            'type' => 'date',
            'length' => null,
            'null' => true,
            'default' => null,
            'comment' => '誕生日',
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
                'id' => 'd0534ccf-4c29-43f9-93d8-aaa426c46b21',
                'screen_name' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'birthday' => '2020-02-26',
                'created' => '2020-02-26 01:12:14',
                'created_by' => 'ad7d1b56-87c1-4181-84b6-01f981096338',
                'modified' => '2020-02-26 01:12:14',
                'modified_by' => 'cf4d0008-2ba7-4b26-8d68-75f730dbee34',
            ],
        ];
        parent::init();
    }
}
