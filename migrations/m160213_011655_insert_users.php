<?php

use yii\db\Schema;
use yii\db\Migration;

class m160213_011655_insert_users extends Migration {
    public function up() {
        $this->delete('user'); //Clean the tabla person

        $this->insert('user', [
            'id' => 1,
            'username' => 'davcocom',
            'email' => 'davcocom@hotmail.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('123456'),
            'auth_key' => '$2y$10$E9yFjEa9J66pE9iJLAlesulPitZMekQhQFZd6MPheq.dyi8ISJ6BS',
            'confirmed_at' => '1453795356',
            'created_at' => '1453795294',
            'updated_at' => '1455295475',
            'person_id' => 1
        ]);

        $this->insert('user', [
            'id' => 2,
            'username' => 'operez',
            'email' => 'operez@hotmail.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('operez'),
            'auth_key' => 'y3pF_7Idk9NkAhuZZ2XCXJ51BIvhz_yn',
            'confirmed_at' => '1453795356',
            'created_at' => '1453795294',
            'updated_at' => '1455295475',
            'person_id' => 2
        ]);

        $this->insert('user', [
            'id' => 3,
            'username' => 'romarin',
            'email' => 'roma@hotmail.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('romarin'),
            'auth_key' => 'DoZdE4KR0BSOfF3oQ2JzFydqHN9w9PWH',
            'confirmed_at' => '1453795356',
            'created_at' => '1453795294',
            'updated_at' => '1455295475',
            'person_id' => 3
        ]);

        $this->insert('user', [
            'id' => 4,
            'username' => 'vfrafer',
            'email' => 'vane@hotmail.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('vfrafer'),
            'auth_key' => 'xaF5gZUVex1kIM0b0r9DpfO6fRKrCU4P',
            'confirmed_at' => '1453795356',
            'created_at' => '1453795294',
            'updated_at' => '1455295475',
            'person_id' => 4
        ]);


    }

    public function down() {
        echo "m160213_011655_insert_users cannot be reverted.\n";

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
