<?php

declare(strict_types=1);

namespace TwitterBot\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CakeDC\Enum\Model\Behavior\EnumBehavior;
use TwitterBot\Model\Behavior\EnumStrategy\ObjectStrategy;
use TwitterBot\Model\Enum\PostType;

/**
 * TwitterBotGodoSayings Model
 *
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying newEmptyEntity()
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying newEntity(array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying[] newEntities(array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying get($primaryKey, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \TwitterBot\Model\Entity\TwitterBotGodoSaying[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TwitterBotGodoSayingsTable extends Table
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

        $this->setTable('twitter_bot_godo_sayings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
//
//        $this->addBehavior('Enum', [
//            'className' => EnumBehavior::class,
//            'classMap' => [
//                'object' => ObjectStrategy::class
//            ],
//            'lists' => [
//                'post_type' => [
//                    'strategy' => 'object',
//                    'className' => PostType::class
//                ]
//            ],
//        ]);

        $this->addBehavior(
            'Timestamp',
            [
                'events' => [
                    'Model.beforeSave' => [
                        'created' => 'new',
                        'modified' => 'always',
                    ],
                ]
            ]
        );
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
            ->scalar('post_type')
            ->notEmptyString('post_type');

        $validator
            ->date('event_day')
            ->allowEmptyDate('event_day');

        $validator
            ->time('event_time')
            ->allowEmptyTime('event_time');

        $validator
            ->scalar('regexp')
            ->allowEmptyString('regexp');

        $validator
            ->scalar('text')
            ->requirePresence('text', 'create')
            ->notEmptyString('text');

        $validator
            ->boolean('is_available')
            ->notEmptyString('is_available');

        $validator
            ->uuid('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->uuid('modified_by')
            ->allowEmptyString('modified_by');

        return $validator;
    }
}
