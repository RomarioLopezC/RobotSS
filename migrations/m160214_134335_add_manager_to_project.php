<?php

use yii\db\Schema;
use yii\db\Migration;

class m160214_134335_add_manager_to_project extends Migration
{
    public function up()
    {
        $this->addColumn('project', 'manager_id', $this->integer()->notNull());


    }

    public function down()
    {
        echo "m160214_134335_add_manager_to_project cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
