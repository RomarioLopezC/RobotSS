<?php

use yii\db\Migration;
use yii\db\Schema;

class m160222_151029_create_student_evidence_table extends Migration
{
    public function up()
    {
        $this->createTable('student_evidence', [
            'task_id' => Schema::TYPE_INTEGER,
            'project_id' => Schema::TYPE_INTEGER,
            'evidence_id' => Schema::TYPE_INTEGER,
            'student_id' => Schema::TYPE_INTEGER,
            'PRIMARY KEY(task_id, project_id, evidence_id, student_id)'
        ]);

        $this->createIndex('idx-student_evidence-task_id', 'student_evidence', 'task_id');
        $this->createIndex('idx-student_evidence-project_id', 'student_evidence', 'project_id');
        $this->createIndex('idx-student_evidence-evidence_id', 'student_evidence', 'evidence_id');
        $this->createIndex('idx-student_evidence-student_id', 'student_evidence', 'student_id');

        $this->addForeignKey('fk-student_evidence-task_id', 'student_evidence', 'task_id', 'task', 'id');
        $this->addForeignKey('fk-student_evidence-project_id', 'student_evidence', 'project_id', 'project', 'id');
        $this->addForeignKey('fk-student_evidence-evidence_id', 'student_evidence', 'evidence_id', 'evidence', 'id');
        $this->addForeignKey('fk-student_evidence-student_id', 'student_evidence', 'student_id', 'student', 'id');
    }

    public function down()
    {
        echo "m160222_151029_create_student_evidence_table cannot be reverted.\n";

        $this->dropTable('student_evidence');
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
