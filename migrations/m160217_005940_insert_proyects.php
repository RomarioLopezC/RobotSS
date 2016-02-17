<?php

use yii\db\Migration;

class m160217_005940_insert_proyects extends Migration {
    public function up() {
        $this->delete('project'); //Clean the tabla person
        $this->delete('project_vacancy');

        $this->insert('project', [
            'id' => 1,
            'name' => 'Proyecto I',
            'dependency' => 'UADY',
            'objective' => 'Terminar la codificacion en Yii del Proyecto I',
            'goals' => 'Registrar alumnos, Asignar Tareas, Configurar el Servidor',
            'actions_by_students' => 'Analisis, Codificar, Probar',
            'induction' => 'Capacitacion para el framework Yii2.0',
            'materials_for_students' => 'No se proporcionara ningun material',
            'economic_support' => 'Se dara un apoyo mensual',
            'human_resource' => 'Un equipo de 3 personas',
            'infraestructure' => 'No aplica',
            'ammount' => 500,
            'manager_id' => 2,
            'approved' => 1
        ]);


        $this->insert('project', [
            'id' => 2,
            'name' => 'Proyecto II',
            'dependency' => 'UADY',
            'objective' => 'Landing Page',
            'goals' => 'Home, Contacto, Servicios',
            'actions_by_students' => 'Analisis, Diseño, Codificar',
            'induction' => 'Capacitacion en Angujar.js',
            'materials_for_students' => 'Una laptop',
            'economic_support' => 'No se dara un apoyo',
            'human_resource' => 'Un equipo de 5 personas',
            'infraestructure' => 'No aplica',
            'ammount' => 0,
            'manager_id' => 2,
            'approved' => 1
        ]);

        $this->insert('project', [
            'id' => 3,
            'name' => 'Proyecto III',
            'dependency' => 'Donde',
            'objective' => 'Proyecto de Videojuegos',
            'goals' => 'Terminar el Proyecto, Dirigir el Proyecto',
            'actions_by_students' => 'Analisis, Diseño, Codificar, Probar',
            'induction' => 'Capacitacion para Android 5.0',
            'materials_for_students' => 'Una tablet',
            'economic_support' => 'Se dara un apoyo mensual',
            'human_resource' => 'Un equipo de 2 personas',
            'infraestructure' => 'No aplica',
            'ammount' => 1000,
            'manager_id' => 2,
            'approved' => 1
        ]);

        $this->insert('project', [
            'id' => 4,
            'name' => 'Proyecto IV',
            'dependency' => 'UADY',
            'objective' => 'Terminar la codificacion en Rails del Proyecto IV',
            'goals' => 'Registrar alumnos, Asignar Tareas, Configurar el Servidor',
            'actions_by_students' => 'Analisis, Codificar, Probar',
            'induction' => 'Capacitacion para Rails 4',
            'materials_for_students' => 'No se proporcionara ningun material',
            'economic_support' => 'Se dara un apoyo mensual',
            'human_resource' => 'Un equipo de 8 personas',
            'infraestructure' => 'No aplica',
            'ammount' => 1500,
            'manager_id' => 2,
            'approved' => 0
        ]);

        $this->insert('project', [
            'id' => 5,
            'name' => 'Proyecto V',
            'dependency' => 'Externo',
            'objective' => 'Corregir el Proyecto V',
            'goals' => 'Agregar funcionalidad, Corregir funcionalidad',
            'actions_by_students' => 'Analisis, Codificar, Probar, Mantener',
            'induction' => 'Curso para el manejo del Proyecto V',
            'materials_for_students' => 'No se proporcionara ningun material',
            'economic_support' => 'Se dara un apoyo mensual',
            'human_resource' => 'Un equipo de 4 personas',
            'infraestructure' => 'No aplica',
            'ammount' => 100,
            'manager_id' => 2,
            'approved' => 1
        ]);

        $this->insert('project_vacancy', [
            'project_id' => 1,
            'vacancy' => 5,
            'id' => 1
        ]);

        $this->insert('project_vacancy', [
            'project_id' => 2,
            'vacancy' => 50,
            'id' => 2
        ]);

        $this->insert('project_vacancy', [
            'project_id' => 3,
            'vacancy' => 55,
            'id' => 3
        ]);

        $this->insert('project_vacancy', [
            'project_id' => 4,
            'vacancy' => 40,
            'id' => 4
        ]);

        $this->insert('project_vacancy', [
            'project_id' => 5,
            'vacancy' => 33,
            'id' => 5
        ]);
    }

    public function down() {
        echo "m160217_005940_insert_proyects cannot be reverted.\n";

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
