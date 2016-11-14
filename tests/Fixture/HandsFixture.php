<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HandsFixture
 *
 */
class HandsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'idHand' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'card1' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card2' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_card1' => ['type' => 'index', 'columns' => ['card1'], 'length' => []],
            'fk_card2' => ['type' => 'index', 'columns' => ['card2'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['idHand'], 'length' => []],
            'fk_card1' => ['type' => 'foreign', 'columns' => ['card1'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_card2' => ['type' => 'foreign', 'columns' => ['card2'], 'references' => ['cards', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'idHand' => 1,
            'card1' => 1,
            'card2' => 1
        ],
    ];
}
