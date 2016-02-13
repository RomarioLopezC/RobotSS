<?php

use yii\db\Schema;
use yii\db\Migration;

class m160213_022709_insert_social_service_manager extends Migration {
    public function up() {
        $this->delete('social_service_manager'); //Clean the tabla person

        $this->insert('social_service_manager', [
            'id' => 1,
            'user_id' => 1,
            'faculty_id' => 1
        ]);
    }

    public function down() {
        echo "m160213_022709_insert_social_service_manager cannot be reverted.\n";

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
