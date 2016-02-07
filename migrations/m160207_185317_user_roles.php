<?php

use yii\db\Schema;
use yii\db\Migration;

class m160207_185317_user_roles extends Migration
{
    public function up()
    {
        //Rol de admin
        $this->insert('auth_item', [
            'name' => 'admin',
            'type' => '1',
            'description' => 'El administrador del sistema para el Servicio social de la UADY',
            'rule_name' => null,
            'data' => null,
            'created_at' => '1453888424',
            'updated_at' => '1453888424'
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'admin',
            'child' => '/admin/*'
        ]);

        //cambiar el nombre con respecto a los roles (projectManager,socialServiceManager,student)
        //rol de administrador de proyectos
        $this->insert('auth_item', [
            'name' => 'projectManager',
            'type' => '1',
            'description' => 'El administrador de proyectos del sistema para el Servicio social de la UADY',
            'rule_name' => null,
            'data' => null,
            'created_at' => '1453888424',
            'updated_at' => '1453888424'
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'projectManager',
            'child' => '/project_manager/*'
        ]);

        //rol de administrador de servicio social
        $this->insert('auth_item', [
            'name' => 'socialServiceManager',
            'type' => '1',
            'description' => 'El administrador de servicio social de una facultad del sistema para el Servicio social de la UADY',
            'rule_name' => null,
            'data' => null,
            'created_at' => '1453888424',
            'updated_at' => '1453888424'
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'socialServiceManager',
            'child' => '/social_service_manager/*'
        ]);

        //rol de estudiante
        $this->insert('auth_item', [
            'name' => 'student',
            'type' => '1',
            'description' => 'El rol estudiante del sistema para el Servicio social de la UADY',
            'rule_name' => null,
            'data' => null,
            'created_at' => '1453888424',
            'updated_at' => '1453888424'
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'student',
            'child' => '/student/*'
        ]);
    }

    public function down()
    {
        echo "m160207_185317_user_roles cannot be reverted.\n";

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
