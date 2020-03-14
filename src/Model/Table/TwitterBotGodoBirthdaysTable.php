<?php

declare(strict_types=1);

namespace TwitterBot\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TwitterBotGodoBirthdays Model
 *
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday newEmptyEntity()
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday newEntity(array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday[] newEntities(array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday get($primaryKey, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoBirthday[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TwitterBotGodoBirthdaysTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('twitter_bot_godo_birthdays');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->uuid('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('screen_name')
            ->maxLength('screen_name', 50)
            ->notEmptyString('screen_name');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->allowEmptyString('name');

        $validator
            ->date('birthday')
            ->allowEmptyDate('birthday');

        $validator
            ->uuid('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->uuid('modified_by')
            ->allowEmptyString('modified_by');

        return $validator;
    }
}
