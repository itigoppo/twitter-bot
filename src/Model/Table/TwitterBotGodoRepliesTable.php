<?php

declare(strict_types=1);

namespace TwitterBot\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TwitterBotGodoReplies Model
 *
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply newEmptyEntity()
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply newEntity(array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply[] newEntities(array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply get($primaryKey, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoReply[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TwitterBotGodoRepliesTable extends Table
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

        $this->setTable('twitter_bot_godo_replies');
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
            ->requirePresence('screen_name', 'create')
            ->notEmptyString('screen_name');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->allowEmptyString('name');

        $validator
            ->scalar('text')
            ->requirePresence('text', 'create')
            ->notEmptyString('text');

        $validator
            ->boolean('is_reply')
            ->notEmptyString('is_reply');

        $validator
            ->dateTime('posted')
            ->requirePresence('posted', 'create')
            ->notEmptyDateTime('posted');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        return $rules;
    }
}
