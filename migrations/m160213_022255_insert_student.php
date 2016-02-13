<?php

use yii\db\Schema;
use yii\db\Migration;

class m160213_022255_insert_student extends Migration {
    public function up() {
        $this->delete('student'); //Clean the tabla person

        $this->insert('student', [
            'id' => 1,
            'user_id' => 3,
            'faculty_id' => 1,
            'current_semester' => 4,
            'enrollment_id' => '09002020'
        ]);
    }

    public function down() {
        echo "m160213_022255_insert_student cannot be reverted.\n";

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
