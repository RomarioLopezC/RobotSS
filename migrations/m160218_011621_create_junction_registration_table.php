<?php

use yii\db\Migration;

class m160218_011621_create_junction_registration_table extends Migration {
    public function up() {
        $this->createTable('registration', [
            'project_id' => $this->integer(),
            'student_id' => $this->integer(),
            'PRIMARY KEY(project_id, student_id)'
        ]);

        $this->createIndex('idx-registration-project_id', 'registration', 'project_id');
        $this->createIndex('idx-registration-student_id', 'registration', 'student_id');

        $this->addForeignKey('fk-registration-project_id', 'registration', 'project_id', 'project', 'id', 'CASCADE');
        $this->addForeignKey('fk-registration-student_id', 'registration', 'student_id', 'student', 'id', 'CASCADE');

    }

    public function down() {
        $this->dropTable('registration');
    }
}
