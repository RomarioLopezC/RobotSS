<?php

use yii\db\Migration;

class m160217_014959_insert_student_profile extends Migration {
    public function up() {
        $this->delete('student_profile');

        $this->insert('student_profile', [
            'project_id' => 1,
            'degree_id' => 1
        ]);

        $this->insert('student_profile', [
            'project_id' => 1,
            'degree_id' => 2
        ]);

        $this->insert('student_profile', [
            'project_id' => 1,
            'degree_id' => 3
        ]);

        $this->insert('student_profile', [
            'project_id' => 1,
            'degree_id' => 4
        ]);

        $this->insert('student_profile', [
            'project_id' => 2,
            'degree_id' => 2
        ]);

        $this->insert('student_profile', [
            'project_id' => 2,
            'degree_id' => 3
        ]);

        $this->insert('student_profile', [
            'project_id' => 3,
            'degree_id' => 3
        ]);

        $this->insert('student_profile', [
            'project_id' => 3,
            'degree_id' => 4
        ]);

        $this->insert('student_profile', [
            'project_id' => 4,
            'degree_id' => 4
        ]);

        $this->insert('student_profile', [
            'project_id' => 4,
            'degree_id' => 1
        ]);

        $this->insert('student_profile', [
            'project_id' => 5,
            'degree_id' => 1
        ]);

        $this->insert('student_profile', [
            'project_id' => 5,
            'degree_id' => 2
        ]);

        $this->insert('student_profile', [
            'project_id' => 5,
            'degree_id' => 3
        ]);
    }

    public function down() {
        echo "m160217_014959_insert_student_profile cannot be reverted.\n";

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
