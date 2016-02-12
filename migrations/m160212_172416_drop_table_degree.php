<?php

use yii\db\Schema;
use yii\db\Migration;

class m160212_172416_drop_table_degree extends Migration
{
    public function up()
    {
        $this->dropTable('degree');
    }

    public function down()
    {
        echo "m160212_172416_drop_table_degree cannot be reverted.\n";

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
