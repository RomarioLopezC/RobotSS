<?php

use yii\db\Schema;
use yii\db\Migration;

class m160212_172513_create_degree_table extends Migration
{
    public function up()
    {
        $this->createTable('degree', [
            'id' => $this->primaryKey(),
            'faculty_id' => $this->integer()->notNull(),
            'campus_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),



        ]);
    }

    public function down()
    {
        echo "m160212_172513_create_degree_table cannot be reverted.\n";

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
