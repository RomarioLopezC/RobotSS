<?php

use yii\db\Migration;

class m160218_004345_drop_project_vacancy_table extends Migration {
    public function up() {
        $this->delete('project'); //Clean the tabla person
        $this->delete('project_vacancy');
        $this->dropTable('project_vacancy');
    }

    public function down() {
        $this->createTable('project_vacancy', [
            'id' => $this->primaryKey()
        ]);
    }
}
