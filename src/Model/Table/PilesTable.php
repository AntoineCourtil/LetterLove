<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Piles Model
 *
 * @method \App\Model\Entity\Pile get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pile findOrCreate($search, callable $callback = null)
 */
class PilesTable extends Table
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

        $this->table('piles');
        $this->displayField('idPile');
        $this->primaryKey('idPile');
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
            ->integer('idPile')
            ->allowEmpty('idPile', 'create');

        $validator
            ->integer('card1')
            ->allowEmpty('card1');

        $validator
            ->integer('card2')
            ->allowEmpty('card2');

        $validator
            ->integer('card3')
            ->allowEmpty('card3');

        $validator
            ->integer('card4')
            ->allowEmpty('card4');

        $validator
            ->integer('card5')
            ->allowEmpty('card5');

        $validator
            ->integer('card6')
            ->allowEmpty('card6');

        $validator
            ->integer('card7')
            ->allowEmpty('card7');

        $validator
            ->integer('card8')
            ->allowEmpty('card8');

        $validator
            ->integer('card9')
            ->allowEmpty('card9');

        $validator
            ->integer('card10')
            ->allowEmpty('card10');

        $validator
            ->integer('card11')
            ->allowEmpty('card11');

        $validator
            ->integer('card12')
            ->allowEmpty('card12');

        $validator
            ->integer('card13')
            ->allowEmpty('card13');

        $validator
            ->integer('card14')
            ->allowEmpty('card14');

        $validator
            ->integer('card15')
            ->allowEmpty('card15');

        $validator
            ->integer('card16')
            ->allowEmpty('card16');

        $validator
            ->allowEmpty('type');

        return $validator;
    }
}
