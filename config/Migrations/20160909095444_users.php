<?php

use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('users');
        $table
            ->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addColumn('name', 'string')
            ->addColumn('last_name', 'string')
            ->addColumn('address', 'string')
            ->addColumn('phone', 'string')
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->create();

        $table->insert([
            'email' => 'uaimedna@gmail.com',
            'password' => '$2y$10$7BJZRpt7puEq8yOCMCtF7.c9FDwbHa5dSjBLlANR9nWV3Wnbjufjq',
            'name' => 'Justas',
            'last_name' => 'Sakalauskas',
            'address' => 'Taikos 4',
            'phone' => '+37062489618'
        ]);
        $table->saveData();
    }
}
