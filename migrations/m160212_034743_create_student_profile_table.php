<?php

use yii\db\Schema;
use yii\db\Migration;

class m160212_034743_create_student_profile_table extends Migration
{
    public function up()
    {
        $this->createTable('student_profile', [
            'project_id' => $this->integer()->notNull(),
            'degree_id' => $this->integer()->notNull(),



        ]);


    }

    public function down()
    {
        echo "m160212_034743_create_student_profile_table cannot be reverted.\n";

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
