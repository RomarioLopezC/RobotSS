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
        //Ruta del modulo de admin
        $this->insert('auth_item', [
            'name' => '/admin/*',
            'type' => '2',
            'description' => 'Ruta para el administrador del sistema para el Servicio social de la UADY',
            'rule_name' => null,
            'data' => null,
            'created_at' => '1453888424',
            'updated_at' => '1453888424'
        ]);

        //Ruta del modulo de admin de proyectos
        $this->insert('auth_item', [
            'name' => '/project_manager/*',
            'type' => '2',
            'description' => 'Ruta para el administrador de proyectos del sistema para el Servicio social de la UADY',
            'rule_name' => null,
            'data' => null,
            'created_at' => '1453888424',
            'updated_at' => '1453888424'
        ]);

        //Ruta del modulo de administrador de servicio social
        $this->insert('auth_item', [
            'name' => '/social_service_manager/*',
            'type' => '2',
            'description' => 'Ruta para el administrador de servicio social de una facultad del sistema para el Servicio social de la UADY',
            'rule_name' => null,
            'data' => null,
            'created_at' => '1453888424',
            'updated_at' => '1453888424'
        ]);

        //Ruta del modulo de estudiante
        $this->insert('auth_item', [
            'name' => '/student/*',
            'type' => '2',
            'description' => 'Ruta para el rol estudiante del sistema para el Servicio social de la UADY',
            'rule_name' => null,
            'data' => null,
            'created_at' => '1453888424',
            'updated_at' => '1453888424'
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
