<?php

use yii\db\Schema;
use yii\db\Migration;

class m160212_154553_insert_degrees extends Migration
{
    public function up()
    {
        $this->insert('degree', [
            'faculty_id' => '1',
            'campus_id' => '1',
            'name' => 'Ingeniería civil',

        ]);
        $this->insert('degree', [
            'faculty_id' => '1',
            'campus_id' => '1',
            'name' => 'Ingeniería Física',

        ]);
        $this->insert('degree', [
            'faculty_id' => '1',
            'campus_id' => '1',
            'name' => 'Ingeniería en Mecatrónica',

        ]);
        $this->insert('degree', [
            'faculty_id' => '1',
            'campus_id' => '1',
            'name' => 'Ingeniería en Energías renovables',

        ]);
    }

    public function down()
    {
        echo "m160212_154553_insert_degrees cannot be reverted.\n";

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
