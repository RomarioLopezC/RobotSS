<?php

use yii\db\Schema;
use yii\db\Migration;

class m160207_175721_adminRole extends Migration
{
    public function up()
    {
        $this->insert('auth_item', [
            'name' => 'admin',
            'type' => '1',
            'description' => 'El administrador del sistema para el Servicio social de la UADY',
            'rule_name' => null,
            'data' => null,
            'created_at' => '1453888424',
            'updated_at' => '1453888424'
        ]);

        $this->insert('auth_assignment', [
            'item_name' => 'admin',
            'user_id' => 10,
            'created_at' => '1453888440'
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'admin',
            'child' => '/admin/*'
        ]);
    }

    public function down()
    {
        echo "m160207_175721_adminRole cannot be reverted.\n";

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
