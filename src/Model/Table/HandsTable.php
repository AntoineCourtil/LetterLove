<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Hands Model
 *
 * @method \App\Model\Entity\Hand get($primaryKey, $options = [])
 * @method \App\Model\Entity\Hand newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Hand[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Hand|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Hand patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Hand[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Hand findOrCreate($search, callable $callback = null)
 */
class HandsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('hands');
        $this->displayField('card2');
        $this->primaryKey('idHand');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('idHand')
            ->allowEmpty('idHand', 'create');

        $validator
            ->integer('card1')
            ->allowEmpty('card1');

        $validator
            ->integer('card2')
            ->allowEmpty('card2');

        $validator
            ->integer('idPlayer')
            ->requirePresence('idPlayer', 'create')
            ->notEmpty('idPlayer');

        $validator
            ->integer('excard')
            ->allowEmpty('excard');

        return $validator;
    }
}
