<?php

use yii\db\Schema;
use yii\db\Migration;

class m160130_180050_create_persons_table extends Migration
{
    public function up()
    {
        $this->createTable('person', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'lastname' => Schema::TYPE_STRING . ' NOT NULL',
            'phone' => Schema::TYPE_STRING
        ]);
    }

    public function down()
    {
        $this->dropTable('person');
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
