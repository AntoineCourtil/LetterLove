<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Games Model
 *
 * @method \App\Model\Entity\Game get($primaryKey, $options = [])
 * @method \App\Model\Entity\Game newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Game[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Game|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Game patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Game[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Game findOrCreate($search, callable $callback = null)
 */
class GamesTable extends Table
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

        $this->table('games');
        $this->displayField('idGame');
        $this->primaryKey('idGame');
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
            ->integer('idGame')
            ->allowEmpty('idGame', 'create');

        $validator
            ->integer('player1')
            ->allowEmpty('player1');

        $validator
            ->integer('player2')
            ->allowEmpty('player2');

        $validator
            ->integer('pioche')
            ->requirePresence('pioche', 'create')
            ->notEmpty('pioche');

        $validator
            ->integer('defausse')
            ->requirePresence('defausse', 'create')
            ->notEmpty('defausse');

        $validator
            ->boolean('playing')
            ->requirePresence('playing', 'create')
            ->notEmpty('playing');

        $validator
            ->integer('player3')
            ->allowEmpty('player3');

        $validator
            ->integer('player4')
            ->allowEmpty('player4');

        return $validator;
    }
}
