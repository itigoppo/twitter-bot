<?php

declare(strict_types=1);

namespace TwitterBot\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TwitterBotGodoSayingsFixture
 */
class TwitterBotGodoSayingsFixture extends TestFixture
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
        'post_type' => [
            'type' => 'string',
            'length' => null,
            'null' => false,
            'default' => 'normal',
            'collate' => 'utf8mb4_general_ci',
            'comment' => '発言タイプ',
            'precision' => null
        ],
        'event_day' => [
            'type' => 'date',
            'length' => null,
            'null' => true,
            'default' => null,
            'comment' => 'タイムイベント用(日付)',
            'precision' => null
        ],
        'event_time' => [
            'type' => 'time',
            'length' => null,
            'null' => true,
            'default' => null,
            'comment' => 'タイムイベント用(時間)',
            'precision' => null
        ],
        'regexp' => [
            'type' => 'text',
            'length' => null,
            'null' => true,
            'default' => null,
            'collate' => 'utf8mb4_general_ci',
            'comment' => 'ヒットさせる文字列',
            'precision' => null
        ],
        'text' => [
            'type' => 'text',
            'length' => null,
            'null' => false,
            'default' => null,
            'collate' => 'utf8mb4_general_ci',
            'comment' => 'リプライ内容',
            'precision' => null
        ],
        'is_available' => [
            'type' => 'boolean',
            'length' => null,
            'null' => false,
            'default' => '1',
            'comment' => '利用可か',
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
                'id' => '164533eb-b536-4d25-b6ba-5cc25dc976eb',
                'post_type' => 'Lorem ipsum dolor sit amet',
                'event_day' => '2020-02-26',
                'event_time' => '01:12:29',
                'regexp' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'text' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'is_available' => 1,
                'created' => '2020-02-26 01:12:29',
                'created_by' => '09bc707a-854a-4d3b-93cb-9aba7f18efad',
                'modified' => '2020-02-26 01:12:29',
                'modified_by' => 'b28f57de-fdaa-4763-a4f0-3b1f7cbc63cc',
            ],
        ];
        parent::init();
    }
}
