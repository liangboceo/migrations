<?php

use Phinx\Migration\AbstractMigration;

final class CreateTableMy extends AbstractMigration
{
    /**
     * Change Method.
     * Write your reversible migrations using this method.
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
    	$table=$this->table("user_info");
    	$table->addColumn("name","string")->create();
    }
}
