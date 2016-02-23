<?php

use yii\db\Schema;
use yii\db\Migration;

class m160215_021527_add_it_to_project_vacancy extends Migration {
    public function up() {
        $this->addColumn('project_vacancy', 'id', $this->integer());
        $this->addPrimaryKey('pk_project_vacancy_id', 'project_vacancy', 'id');
    }

    public function down() {
        echo "m160215_021527_add_it_to_project_vacancy cannot be reverted.\n";

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
