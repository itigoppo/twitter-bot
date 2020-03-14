<?php

declare(strict_types=1);

namespace TwitterBot\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TwitterBotGodoRepliesFixture
 */
class TwitterBotGodoRepliesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => [
            'type' => 'integer',
            'length' => 20,
            'unsigned' => false,
            'null' => false,
            'default' => null,
            'comment' => 'リプライID',
            'precision' => null,
            'autoIncrement' => null
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
        'text' => [
            'type' => 'text',
            'length' => null,
            'null' => false,
            'default' => null,
            'collate' => 'utf8mb4_general_ci',
            'comment' => 'リプライ内容',
            'precision' => null
        ],
        'is_reply' => [
            'type' => 'boolean',
            'length' => null,
            'null' => false,
            'default' => '0',
            'comment' => 'リプライ済みか',
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
                'id' => 1,
                'screen_name' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'text' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'is_reply' => 1,
                'created' => '2020-02-26 01:12:23',
            ],
        ];
        parent::init();
    }
}
