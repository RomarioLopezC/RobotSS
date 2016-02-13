<?php

use yii\db\Schema;
use yii\db\Migration;

class m160213_021023_drop_last_name_from_project_manager extends Migration {
    public function up() {
        $this->dropColumn('project_manager', 'last_name');
    }

    public function down() {
        echo "m160213_021023_drop_last_name_from_project_manager cannot be reverted.\n";

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
