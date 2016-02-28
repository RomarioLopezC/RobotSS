<?php

use yii\db\Migration;
use yii\db\Schema;


class m160226_010146_alter_evidence_column_from_student_evidence extends Migration
{
    public function up()
    {
        $this->alterColumn('student_evidence', 'evidence_id', Schema::TYPE_INTEGER . ' NULL');
    }

    public function down()
    {
        echo "m160226_010146_alter_evidence_column_from_student_evidence cannot be reverted.\n";

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
