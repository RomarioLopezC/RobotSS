<?php

use yii\db\Schema;
use yii\db\Migration;

class m160130_180737_add_person_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'person_id', $this->integer());

        $this->createIndex('idx-user-person_id', 'user', 'person_id');
        $this->addForeignKey('fk-user-person_id', 'user', 'person_id', 'person', 'id', 'CASCADE');
    }

    public function down()
    {
        echo "m160130_180737_add_person_to_user cannot be reverted.\n";

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
