<?php

use yii\db\Migration;

class m160215_002354_drop_student_profile_table extends Migration {
    public function up() {
        $this->dropTable('student_profile');
    }

    public function down() {
        $this->createTable('student_profile', [
            'project_id' => $this->integer()->notNull(),
            'degree_id' => $this->integer()->notNull(),
        ]);
    }
}
