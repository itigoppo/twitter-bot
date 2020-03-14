<?php

declare(strict_types=1);

namespace TwitterBot\Model\Entity;

use Cake\ORM\Entity;

/**
 * TwitterBotReplyContinuous Entity
 *
 * @property string $id
 * @property string $screen_name
 * @property string $target_screen_name
 * @property int $count
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class TwitterBotReplyContinuous extends Entity
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
        'screen_name' => true,
        'target_screen_name' => true,
        'count' => true,
        'created' => true,
        'modified' => true,
    ];
}
