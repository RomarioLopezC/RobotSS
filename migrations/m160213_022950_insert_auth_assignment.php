<?php

use yii\db\Schema;
use yii\db\Migration;

class m160213_022950_insert_auth_assignment extends Migration {
    public function up() {
        $this->delete('auth_assignment'); //Clean the tabla person

        $this->insert('auth_assignment', [
            'item_name' => 'projectManager' ,
            'user_id' => 2,
            'created_at' => '1455328256'
        ]);

        $this->insert('auth_assignment', [
            'item_name' => 'student' ,
            'user_id' => 3,
            'created_at' => '1455328256'
        ]);

        $this->insert('auth_assignment', [
            'item_name' => 'socialServiceManager' ,
            'user_id' => 1,
            'created_at' => '1455328256'
        ]);

        $this->insert('auth_assignment', [
            'item_name' => 'admin' ,
            'user_id' => 4,
            'created_at' => '1455328256'
        ]);
    }

    public function down() {
        echo "m160213_022950_insert_auth_assignment cannot be reverted.\n";

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
