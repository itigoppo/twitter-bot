<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class InitialTwitterBot extends AbstractMigration
{
    public function up()
    {
        $this->table('twitter_bot_restrictions', ['id' => false, 'primary_key' => ['id'], 'comment' => 'bot扱いのIDリスト'])
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

        $this->table(
            'twitter_bot_reply_continuous',
            ['id' => false, 'primary_key' => ['id'], 'comment' => 'botとの連続やり取り回数']
        )
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
                'target_screen_name',
                'string',
                [
                    'comment' => '対象ユーザーアカウント名',
                    'default' => '',
                    'limit' => 50,
                    'null' => false,
                ]
            )
            ->addColumn(
                'count',
                'integer',
                [
                    'comment' => '連続数',
                    'null' => false,
                    'signed' => false,
                    'default' => 0,
                    'limit' => 5,
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
                'modified',
                'datetime',
                [
                    'comment' => '更新日時',
                    'default' => null,
                    'null' => false,
                ]
            )
            ->create();
    }

    public function down()
    {
        $this->table('twitter_bot_restrictions')->drop()->save();
        $this->table('twitter_bot_reply_continuous')->drop()->save();
    }
}
