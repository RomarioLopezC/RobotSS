<?php

use yii\db\Migration;

class m160217_014440_insert_auth_assigment extends Migration {
    public function up() {
        $this->insert('auth_assignment', [
            'item_name' => 'student' ,
            'user_id' => 5,
            'created_at' => '1455328256'
        ]);
    }

    public function down() {
        echo "m160217_014440_insert_auth_assigment cannot be reverted.\n";

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
