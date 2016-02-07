<?php

use yii\db\Schema;
use yii\db\Migration;

class m160207_223435_role_permission_assignment extends Migration
{
    public function up()
    {
        $this->insert('auth_item_child', [
            'parent' => 'admin',
            'child' => '/admin/*'
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'socialServiceManager',
            'child' => '/social_service_manager/*'
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'projectManager',
            'child' => '/project_manager/*'
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'student',
            'child' => '/student/*'
        ]);
    }

    public function down()
    {
        echo "m160207_223435_role_permission_assignment cannot be reverted.\n";

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
