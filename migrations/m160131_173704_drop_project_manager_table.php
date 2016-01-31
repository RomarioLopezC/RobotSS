<?php

use yii\db\Schema;
use yii\db\Migration;

class m160131_173704_drop_project_manager_table extends Migration {
    public function up() {
        $this->dropTable('project_manager');
    }

    public function down() {
        echo "m160131_173704_drop_project_manager_table cannot be reverted.\n";

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
