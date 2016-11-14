<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PilesTable Test Case
 */
class PilesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PilesTable
     */
    public $Piles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.piles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Piles') ? [] : ['className' => 'App\Model\Table\PilesTable'];
        $this->Piles = TableRegistry::get('Piles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Piles);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
