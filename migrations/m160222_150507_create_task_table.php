<?php

use yii\db\Migration;
use yii\db\Schema;

class m160222_150507_create_task_table extends Migration
{
    public function up()
    {
        $this->createTable('task', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
            'delivery_date' => Schema::TYPE_DATE,
            'created_at' => Schema::TYPE_DATE,
            'updated_at' => Schema::TYPE_DATE,
            'status' => Schema::TYPE_STRING,
            'project_id' => Schema::TYPE_INTEGER
        ]);

        $this->createIndex('idx-task-project_id', 'task', 'project_id');

        $this->addForeignKey('fk-task-project_id', 'task', 'project_id', 'project', 'id');
    }

    public function down()
    {
        echo "m160222_150507_create_task_table cannot be reverted.\n";

        $this->dropTable('task');
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
