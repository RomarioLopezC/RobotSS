<?php

use yii\db\Schema;
use yii\db\Migration;

class m160213_164854_create_registration_table extends Migration
{
    public function up()
    {
        $this->createTable('registration', [

            'project_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'student_status' => $this->string(255)->notNull(),




        ]);
    }

    public function down()
    {
        echo "m160213_041329_create_table_project_vacancy cannot be reverted.\n";

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
