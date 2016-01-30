<?php

use yii\db\Schema;
use yii\db\Migration;

class m160130_182612_delete_degree_from_student extends Migration
{
    public function up()
    {
        $this->dropForeignKey('student_ibfk_2', 'student');
        $this->dropColumn('student', 'degree_id');
    }

    public function down()
    {
        echo "m160130_182612_delete_degree_from_student cannot be reverted.\n";

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
