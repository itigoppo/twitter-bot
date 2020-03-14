<?php

declare(strict_types=1);

namespace TwitterBot\Model\Entity;

use Cake\ORM\Entity;

/**
 * TwitterBotGodoReply Entity
 *
 * @property string $id
 * @property string $status_id
 * @property string $user_id
 * @property string $screen_name
 * @property string|null $name
 * @property string $text
 * @property bool $is_reply
 * @property \Cake\I18n\FrozenTime $posted
 * @property \Cake\I18n\FrozenTime $created
 */
class TwitterBotGodoReply extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'status_id' => true,
        'user_id' => true,
        'screen_name' => true,
        'name' => true,
        'text' => true,
        'is_reply' => true,
        'posted' => true,
        'created' => true,
    ];
}
