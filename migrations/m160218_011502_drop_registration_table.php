<?php

use yii\db\Migration;

class m160218_011502_drop_registration_table extends Migration {
    public function up() {
        $this->dropTable('registration');
    }

    public function down() {
        $this->createTable('registration', [
            'id' => $this->primaryKey()
        ]);
    }
}
