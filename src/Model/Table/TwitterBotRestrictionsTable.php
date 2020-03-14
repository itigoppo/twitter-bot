<?php

declare(strict_types=1);

namespace TwitterBot\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TwitterBotRestrictions Model
 *
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction newEmptyEntity()
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction newEntity(array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction[] newEntities(array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction get($primaryKey, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotRestriction[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TwitterBotRestrictionsTable extends Table
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

        $this->setTable('twitter_bot_restrictions');
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
            ->uuid('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->uuid('modified_by')
            ->allowEmptyString('modified_by');

        return $validator;
    }
}
