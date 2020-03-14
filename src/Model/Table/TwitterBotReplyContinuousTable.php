<?php

declare(strict_types=1);

namespace TwitterBot\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TwitterBotReplyContinuous Model
 *
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous newEmptyEntity()
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous newEntity(array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous[] newEntities(array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous get($primaryKey, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotReplyContinuous[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TwitterBotReplyContinuousTable extends Table
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

        $this->setTable('twitter_bot_reply_continuous');
        $this->setDisplayField('id');
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
            ->scalar('target_screen_name')
            ->maxLength('target_screen_name', 50)
            ->notEmptyString('target_screen_name');

        $validator
            ->integer('count')
            ->notEmptyString('count');

        return $validator;
    }
}
