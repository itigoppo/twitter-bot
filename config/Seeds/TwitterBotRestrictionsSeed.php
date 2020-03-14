<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * TwitterBotRestrictions seed.
 */
class TwitterBotRestrictionsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => \Cake\Utility\Text::uuid(),
                'screen_name' => '11panda',
                'created' => \Cake\I18n\FrozenTime::now(),
                'modified' => \Cake\I18n\FrozenTime::now(),
            ],
            [
                'id' => \Cake\Utility\Text::uuid(),
                'screen_name' => '11352',
                'created' => \Cake\I18n\FrozenTime::now(),
                'modified' => \Cake\I18n\FrozenTime::now(),
            ],
            [
                'id' => \Cake\Utility\Text::uuid(),
                'screen_name' => '11510_',
                'created' => \Cake\I18n\FrozenTime::now(),
                'modified' => \Cake\I18n\FrozenTime::now(),
            ],
            [
                'id' => \Cake\Utility\Text::uuid(),
                'screen_name' => 'wakatter',
                'created' => \Cake\I18n\FrozenTime::now(),
                'modified' => \Cake\I18n\FrozenTime::now(),
            ],
            [
                'id' => \Cake\Utility\Text::uuid(),
                'screen_name' => 'wakaranakatter',
                'created' => \Cake\I18n\FrozenTime::now(),
                'modified' => \Cake\I18n\FrozenTime::now(),
            ],
            [
                'id' => \Cake\Utility\Text::uuid(),
                'screen_name' => 'chihiro_fake',
                'created' => \Cake\I18n\FrozenTime::now(),
                'modified' => \Cake\I18n\FrozenTime::now(),
            ],
        ];

        $table = $this->table('twitter_bot_restrictions');
        $table->insert($data)->save();
    }
}
