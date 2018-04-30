<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FurnitureTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FurnitureTable Test Case
 */
class FurnitureTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FurnitureTable
     */
    public $Furniture;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.furniture'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Furniture') ? [] : ['className' => 'App\Model\Table\FurnitureTable'];
        $this->Furniture = TableRegistry::get('Furniture', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Furniture);

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
