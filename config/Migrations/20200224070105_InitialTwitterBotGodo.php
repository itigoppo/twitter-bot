<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class InitialTwitterBotGodo extends AbstractMigration
{
    public function up()
    {
        $this->table('twitter_bot_godo_replies', ['id' => false, 'primary_key' => ['id']])
            ->addColumn(
                'id',
                'uuid',
                [
                    'comment' => 'ID',
                    'null' => false,
                ]
            )
            ->addColumn(
                'status_id',
                'string',
                [
                    'comment' => 'リプライID',
                    'null' => false,
                    'limit' => 50,
                ]
            )
            ->addColumn(
                'user_id',
                'string',
                [
                    'comment' => 'ユーザーID',
                    'null' => false,
                    'limit' => 50,
                ]
            )
            ->addColumn(
                'screen_name',
                'string',
                [
                    'comment' => 'ユーザーアカウント名',
                    'limit' => 50,
                    'null' => false,
                ]
            )
            ->addColumn(
                'name',
                'string',
                [
                    'comment' => 'ユーザー名',
                    'default' => null,
                    'limit' => 50,
                    'null' => true,
                ]
            )
            ->addColumn(
                'text',
                'text',
                [
                    'comment' => 'リプライ内容',
                    'null' => false,
                ]
            )
            ->addColumn(
                'is_reply',
                'boolean',
                [
                    'comment' => 'リプライ済みか',
                    'default' => false,
                    'null' => false,
                ]
            )
            ->addColumn(
                'posted',
                'datetime',
                [
                    'comment' => 'リプライ日時',
                    'default' => null,
                    'null' => false,
                ]
            )
            ->addColumn(
                'created',
                'datetime',
                [
                    'comment' => '作成日時',
                    'default' => null,
                    'null' => false,
                ]
            )
            ->addIndex(
                'status_id',
                [
                    'name' => 'idx_status_id',
                    'unique' => true,
                ]
            )
            ->create();

        $this->table('twitter_bot_godo_sayings', ['id' => false, 'primary_key' => ['id']])
            ->addColumn(
                'id',
                'uuid',
                [
                    'comment' => 'ID',
                    'null' => false,
                ]
            )
            ->addColumn(
                'post_type',
                'enum',
                [
                    'values' => [
                        'normal',
                        'day',
                        'time',
                        'reply',
                        'match',
                        'birthday',
                    ],
                    'comment' => '発言タイプ',
                    'default' => 'normal',
                    'null' => false,
                ]
            )
            ->addColumn(
                'event_day',
                'date',
                [
                    'comment' => 'タイムイベント用(日付)',
                    'null' => true,
                    'default' => null,
                ]
            )
            ->addColumn(
                'event_time',
                'time',
                [
                    'comment' => 'タイムイベント用(時間)',
                    'null' => true,
                    'default' => null,
                ]
            )
            ->addColumn(
                'regexp',
                'text',
                [
                    'comment' => 'ヒットさせる文字列',
                    'null' => true,
                ]
            )
            ->addColumn(
                'text',
                'text',
                [
                    'comment' => 'リプライ内容',
                    'null' => false,
                ]
            )
            ->addColumn(
                'is_available',
                'boolean',
                [
                    'comment' => '利用可か',
                    'default' => true,
                    'null' => false,
                ]
            )
            ->addColumn(
                'created',
                'datetime',
                [
                    'comment' => '作成日時',
                    'default' => null,
                    'null' => false,
                ]
            )
            ->addColumn(
                'created_by',
                'char',
                [
                    'comment' => '作成者ID',
                    'default' => null,
                    'limit' => 36,
                    'null' => true,
                ]
            )
            ->addColumn(
                'modified',
                'datetime',
                [
                    'comment' => '更新日時',
                    'default' => null,
                    'null' => false,
                ]
            )
            ->addColumn(
                'modified_by',
                'char',
                [
                    'comment' => '更新者ID',
                    'default' => null,
                    'limit' => 36,
                    'null' => true,
                ]
            )
            ->create();

        $this->table('twitter_bot_godo_birthdays', ['id' => false, 'primary_key' => ['id']])
            ->addColumn(
                'id',
                'uuid',
                [
                    'comment' => 'ID',
                    'null' => false,
                ]
            )
            ->addColumn(
                'screen_name',
                'string',
                [
                    'comment' => 'ユーザーアカウント名',
                    'default' => '',
                    'limit' => 50,
                    'null' => false,
                ]
            )
            ->addColumn(
                'name',
                'string',
                [
                    'comment' => 'ユーザー名',
                    'default' => null,
                    'limit' => 50,
                    'null' => true,
                ]
            )
            ->addColumn(
                'birthday',
                'date',
                [
                    'comment' => '誕生日',
                    'null' => true,
                    'default' => null,
                ]
            )
            ->addColumn(
                'created',
                'datetime',
                [
                    'comment' => '作成日時',
                    'default' => null,
                    'null' => false,
                ]
            )
            ->addColumn(
                'created_by',
                'char',
                [
                    'comment' => '作成者ID',
                    'default' => null,
                    'limit' => 36,
                    'null' => true,
                ]
            )
            ->addColumn(
                'modified',
                'datetime',
                [
                    'comment' => '更新日時',
                    'default' => null,
                    'null' => false,
                ]
            )
            ->addColumn(
                'modified_by',
                'char',
                [
                    'comment' => '更新者ID',
                    'default' => null,
                    'limit' => 36,
                    'null' => true,
                ]
            )
            ->create();
    }

    public function down()
    {
        $this->table('twitter_bot_godo_replies')->drop()->save();
        $this->table('twitter_bot_godo_sayings')->drop()->save();
        $this->table('twitter_bot_godo_birthdays')->drop()->save();
    }
}
