<?php

use yii\db\Schema;
use yii\db\Migration;

class m160212_032833_create_project_table extends Migration
{
    public function up()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->notNull(),
            'dependency' => $this->string(200)->notNull(),
            'objective' => $this->string(500)->notNull(),
            'goals' => $this->string(500)->notNull(),
            'actions_by_students' => $this->string(500)->notNull(),
            'induction' => $this->string(500)->notNull(),
            'materials_for_students' => $this->string(500)->notNull(),
            'economic_support' => $this->string(500)->notNull(),
            'human_resource' => $this->string(500)->notNull(),
            'infraestructure' => $this->string(500)->notNull(),
            'ammount' => $this->string(500)->notNull(),
            'approved' => $this->string(500),
        ]);
    }

    public function down()
    {
        echo "m160212_032833_create_project_table cannot be reverted.\n";

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
