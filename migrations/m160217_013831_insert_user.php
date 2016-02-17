<?php

use yii\db\Migration;

class m160217_013831_insert_user extends Migration {
    public function up() {

        $this->insert('person', [
            'id' => 5,
            'name' => 'Carlos',
            'lastname' => 'Araujo',
            'phone' => '9203023',
        ]);

        $this->insert('user', [
            'id' => 5,
            'username' => 'araujo',
            'email' => 'araujo@hotmail.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('araujo'),
            'auth_key' => 'xaF5gZUVex1kIM0b0r9DpfO6fRKrCU4P',
            'confirmed_at' => '1453795356',
            'created_at' => '1453795294',
            'updated_at' => '1455295475',
            'person_id' => 5
        ]);

        $this->insert('student', [
            'id' => 2,
            'user_id' => 5,
            'faculty_id' => 2,
            'current_semester' => 6,
            'enrollment_id' => '09003020'
        ]);

    }

    public function down() {
        echo "m160217_013831_insert_user cannot be reverted.\n";

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
