<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PilesFixture
 *
 */
class PilesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'idPile' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'card1' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card2' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card3' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card4' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card5' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card6' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card7' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card8' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card9' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card10' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card11' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card12' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card13' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card14' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card15' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card16' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'type' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'pile_fk_card1' => ['type' => 'index', 'columns' => ['card1'], 'length' => []],
            'pile_fk_card2' => ['type' => 'index', 'columns' => ['card2'], 'length' => []],
            'pile_fk_card3' => ['type' => 'index', 'columns' => ['card3'], 'length' => []],
            'pile_fk_card4' => ['type' => 'index', 'columns' => ['card4'], 'length' => []],
            'pile_fk_card5' => ['type' => 'index', 'columns' => ['card5'], 'length' => []],
            'pile_fk_card6' => ['type' => 'index', 'columns' => ['card6'], 'length' => []],
            'pile_fk_card7' => ['type' => 'index', 'columns' => ['card7'], 'length' => []],
            'pile_fk_card8' => ['type' => 'index', 'columns' => ['card8'], 'length' => []],
            'pile_fk_card9' => ['type' => 'index', 'columns' => ['card9'], 'length' => []],
            'pile_fk_card10' => ['type' => 'index', 'columns' => ['card10'], 'length' => []],
            'pile_fk_card11' => ['type' => 'index', 'columns' => ['card11'], 'length' => []],
            'pile_fk_card12' => ['type' => 'index', 'columns' => ['card12'], 'length' => []],
            'pile_fk_card13' => ['type' => 'index', 'columns' => ['card13'], 'length' => []],
            'pile_fk_card14' => ['type' => 'index', 'columns' => ['card14'], 'length' => []],
            'pile_fk_card15' => ['type' => 'index', 'columns' => ['card15'], 'length' => []],
            'pile_fk_card16' => ['type' => 'index', 'columns' => ['card16'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['idPile'], 'length' => []],
            'pile_fk_card1' => ['type' => 'foreign', 'columns' => ['card1'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card10' => ['type' => 'foreign', 'columns' => ['card10'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card11' => ['type' => 'foreign', 'columns' => ['card11'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card12' => ['type' => 'foreign', 'columns' => ['card12'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card13' => ['type' => 'foreign', 'columns' => ['card13'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card14' => ['type' => 'foreign', 'columns' => ['card14'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card15' => ['type' => 'foreign', 'columns' => ['card15'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card16' => ['type' => 'foreign', 'columns' => ['card16'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card2' => ['type' => 'foreign', 'columns' => ['card2'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card3' => ['type' => 'foreign', 'columns' => ['card3'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card4' => ['type' => 'foreign', 'columns' => ['card4'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card5' => ['type' => 'foreign', 'columns' => ['card5'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card6' => ['type' => 'foreign', 'columns' => ['card6'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card7' => ['type' => 'foreign', 'columns' => ['card7'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card8' => ['type' => 'foreign', 'columns' => ['card8'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pile_fk_card9' => ['type' => 'foreign', 'columns' => ['card9'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'idPile' => 1,
            'card1' => 1,
            'card2' => 1,
            'card3' => 1,
            'card4' => 1,
            'card5' => 1,
            'card6' => 1,
            'card7' => 1,
            'card8' => 1,
            'card9' => 1,
            'card10' => 1,
            'card11' => 1,
            'card12' => 1,
            'card13' => 1,
            'card14' => 1,
            'card15' => 1,
            'card16' => 1,
            'type' => 'Lorem ipsum dolor '
        ],
    ];
}
