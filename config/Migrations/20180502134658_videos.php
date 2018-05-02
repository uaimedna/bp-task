<?php

use Phinx\Migration\AbstractMigration;

class Videos extends AbstractMigration
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
        $table = $this->table('videos');
        $table
            ->addColumn('video_id', 'string')
            ->addColumn('channel_id', 'string')
            ->addColumn('tags', 'string')
            ->addColumn('performanse_rating', 'integer')
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->create();
        
        
        $table = $this->table('video_stats'); 
        $table
            ->addColumn('video_id', 'string')
            ->addColumn('view_count', 'string')
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->create();
    }
}
