<?php

use Phinx\Migration\AbstractMigration;

class Files extends AbstractMigration
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
        $table = $this->table('files');
        $table
            ->addColumn('user_id', 'integer')
            ->addColumn('name', 'string')
            ->addColumn('path', 'string')
            ->addColumn('type', 'string')
            ->addColumn('category', 'integer')
            ->addColumn('access', 'integer')
            ->addForeignKey('user_id', 'users', 'id')
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->create();
    }
}
