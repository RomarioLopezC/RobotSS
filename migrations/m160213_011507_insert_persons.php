<?php

use yii\db\Schema;
use yii\db\Migration;

class m160213_011507_insert_persons extends Migration {
    public function up() {
        $this->delete('person'); //Clean the tabla person

        $this->insert('person', [
            'id' => 1,
            'name' => 'David',
            'lastname' => 'Cocom',
            'phone' => '9202222',
        ]);

        $this->insert('person', [
            'id' => 2,
            'name' => 'Oscar',
            'lastname' => 'Perez',
            'phone' => '9202424',
        ]);

        $this->insert('person', [
            'id' => 3,
            'name' => 'Romario',
            'lastname' => 'Lopez',
            'phone' => '9202525',
        ]);

        $this->insert('person', [
            'id' => 4,
            'name' => 'Vanessa',
            'lastname' => 'Fragoso',
            'phone' => '9202323',
        ]);

    }

    public function down() {
        echo "m160213_011507_insert_persons cannot be reverted.\n";

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
