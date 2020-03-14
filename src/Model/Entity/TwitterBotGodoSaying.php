<?php

declare(strict_types=1);

namespace TwitterBot\Model\Entity;

use Cake\ORM\Entity;

/**
 * TwitterBotGodoSaying Entity
 *
 * @property string $id
 * @property string $post_type
 * @property \Cake\I18n\FrozenDate|null $event_day
 * @property \Cake\I18n\FrozenTime|null $event_time
 * @property string|null $regexp
 * @property string $text
 * @property bool $is_available
 * @property \Cake\I18n\FrozenTime $created
 * @property string|null $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $modified_by
 */
class TwitterBotGodoSaying extends Entity
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
        'post_type' => true,
        'event_day' => true,
        'event_time' => true,
        'regexp' => true,
        'text' => true,
        'is_available' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
    ];
}
