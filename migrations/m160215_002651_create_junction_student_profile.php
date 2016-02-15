<?php

use yii\db\Migration;

class m160215_002651_create_junction_student_profile extends Migration {
    public function up() {
        $this->createTable('student_profile', [
            'project_id' => $this->integer(),
            'degree_id' => $this->integer(),
            'PRIMARY KEY(project_id, degree_id)'
        ]);

        $this->createIndex('idx-student_profile-project_id', 'student_profile', 'project_id');
        $this->createIndex('idx-student_profile-degree_id', 'student_profile', 'degree_id');

        $this->addForeignKey('fk-student_profile-project_id', 'student_profile', 'project_id', 'project', 'id', 'CASCADE');
        $this->addForeignKey('fk-student_profile-degree_id', 'student_profile', 'degree_id', 'degree', 'id', 'CASCADE');
    }

    public function down() {
        $this->dropTable('student_profile');
    }
}
