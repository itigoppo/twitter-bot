<?php

declare(strict_types=1);

namespace TwitterBot\Model\Entity;

use Cake\ORM\Entity;

/**
 * TwitterBotGodoBirthday Entity
 *
 * @property string $id
 * @property string $screen_name
 * @property string|null $name
 * @property \Cake\I18n\FrozenDate|null $birthday
 * @property \Cake\I18n\FrozenTime $created
 * @property string|null $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $modified_by
 */
class TwitterBotGodoBirthday extends Entity
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
        'name' => true,
        'birthday' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
    ];
}
