<?php

use Netease\Migration\AbstractMigration;

final class AddCloumnUserNameToUserInfo extends AbstractMigration
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
	    $table->addColumn("user_name","string")->save();
    }
}
