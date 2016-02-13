<?php

use yii\db\Schema;
use yii\db\Migration;

class m160213_021707_insert_project_manager extends Migration {
    public function up() {
        $this->delete('project_manager'); //Clean the tabla person

        $this->insert('project_manager', [
            'id' => 2,
            'user_id' => 2,
            'organization' => 'UADY'
        ]);
    }

    public function down() {
        echo "m160213_021707_insert_project_manager cannot be reverted.\n";

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
