<?php

use yii\db\Migration;

class m160218_004536_create_project_vacancy_table extends Migration {
    public function up() {
        $this->createTable('project_vacancy', [
            'id' => $this->primaryKey(),
            'vacancy' => $this->integer()->notNull(),
            'project_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-project_vacancy-project_id', 'project_vacancy', 'project_id');

        $this->addForeignKey('fk-project_vacancy-project_id', 'project_vacancy', 'project_id', 'project', 'id', 'CASCADE');
    }

    public function down() {
        $this->dropTable('project_vacancy');
    }
}
