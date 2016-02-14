<?php

use yii\db\Schema;
use yii\db\Migration;

class m160213_153434_add_degree_to_student extends Migration
{
    public function up()
    {
        $this->addColumn('student', 'degree_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('student', 'degree_id');
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
