<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GamesFixture
 *
 */
class GamesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'idGame' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'player1' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'player2' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'pioche' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'defausse' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'playing' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'player3' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'player4' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'party_fk_player1' => ['type' => 'index', 'columns' => ['player1'], 'length' => []],
            'party_fk_player2' => ['type' => 'index', 'columns' => ['player2'], 'length' => []],
            'party_fk_pioche' => ['type' => 'index', 'columns' => ['pioche'], 'length' => []],
            'party_fk_defausse' => ['type' => 'index', 'columns' => ['defausse'], 'length' => []],
            'party_fk_player3' => ['type' => 'index', 'columns' => ['player3'], 'length' => []],
            'party_fk_player4' => ['type' => 'index', 'columns' => ['player4'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['idGame'], 'length' => []],
            'party_fk_defausse' => ['type' => 'foreign', 'columns' => ['defausse'], 'references' => ['piles', 'idPile'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'party_fk_pioche' => ['type' => 'foreign', 'columns' => ['pioche'], 'references' => ['piles', 'idPile'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'party_fk_player1' => ['type' => 'foreign', 'columns' => ['player1'], 'references' => ['players', 'idPlayer'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'party_fk_player2' => ['type' => 'foreign', 'columns' => ['player2'], 'references' => ['players', 'idPlayer'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'party_fk_player3' => ['type' => 'foreign', 'columns' => ['player3'], 'references' => ['players', 'idPlayer'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'party_fk_player4' => ['type' => 'foreign', 'columns' => ['player4'], 'references' => ['players', 'idPlayer'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'idGame' => 1,
            'player1' => 1,
            'player2' => 1,
            'pioche' => 1,
            'defausse' => 1,
            'playing' => 1,
            'player3' => 1,
            'player4' => 1
        ],
    ];
}
