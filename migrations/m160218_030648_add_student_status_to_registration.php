<?php

use yii\db\Migration;

class m160218_030648_add_student_status_to_registration extends Migration {
    public function up() {
        $this->addColumn('registration', 'student_status', $this->string());
    }

    public function down() {
        echo "m160218_005003_insert_proyects cannot be reverted.\n";

        return false;
    }
}
