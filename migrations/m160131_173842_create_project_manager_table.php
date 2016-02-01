<?php

use yii\db\Schema;
use yii\db\Migration;

class m160131_173842_create_project_manager_table extends Migration {
    public function up() {
        $this->createTable('project_manager', [
            'id' => $this->primaryKey(),
            'last_name' => $this->string(255)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'organization' => $this->string(255)->notNull()
        ]);
    }

    public function down() {
        echo "m160131_173842_create_project_manager_table cannot be reverted.\n";

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
