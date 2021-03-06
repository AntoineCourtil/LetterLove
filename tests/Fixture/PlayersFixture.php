<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlayersFixture
 *
 */
class PlayersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'idPlayer' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'hand' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 25, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ready' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'defausse' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'playing' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'protected' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_hand' => ['type' => 'index', 'columns' => ['hand'], 'length' => []],
            'player_fk_defausse' => ['type' => 'index', 'columns' => ['defausse'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['idPlayer'], 'length' => []],
            'fk_hand' => ['type' => 'foreign', 'columns' => ['hand'], 'references' => ['hands', 'idHand'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'player_fk_defausse' => ['type' => 'foreign', 'columns' => ['defausse'], 'references' => ['piles', 'idPile'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'idPlayer' => 1,
            'hand' => 1,
            'name' => 'Lorem ipsum dolor sit a',
            'ready' => 1,
            'defausse' => 1,
            'playing' => 1,
            'protected' => 1
        ],
    ];
}
