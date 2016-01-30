<?php

use yii\db\Schema;
use yii\db\Migration;

class m160130_212648_add_enrollment_to_student extends Migration
{
    public function up()
    {
        $this->addColumn('student', 'enrollment_id', $this->string());
    }

    public function down()
    {
        echo "m160130_212648_add_enrollment_to_student cannot be reverted.\n";

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
