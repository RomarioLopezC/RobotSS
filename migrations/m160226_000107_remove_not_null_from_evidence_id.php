<?php

use yii\db\Migration;

class m160226_000107_remove_not_null_from_evidence_id extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk-student_evidence-evidence_id', 'student_evidence');
        $this->dropIndex('idx-student_evidence-evidence_id', 'student_evidence');
        $this->dropColumn('student_evidence','evidence_id');
        $this->addColumn('student_evidence', 'evidence_id', $this->integer());
        $this->createIndex('idx-student_evidence-evidence_id', 'student_evidence', 'evidence_id');
        $this->addForeignKey('fk-student_evidence-evidence_id', 'student_evidence', 'evidence_id', 'evidence', 'id');
    }

    public function down()
    {
        echo "m160226_000107_remove_not_null_from_evidence_id cannot be reverted.\n";

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
