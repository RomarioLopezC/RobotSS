<?php

use yii\db\Schema;
use yii\db\Migration;

class m160213_041329_create_table_project_vacancy extends Migration
{
    public function up()
    {
        $this->createTable('project_vacancy', [

            'project_id' => $this->integer()->notNull(),
            'vacancy' => $this->integer()->notNull(),




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
