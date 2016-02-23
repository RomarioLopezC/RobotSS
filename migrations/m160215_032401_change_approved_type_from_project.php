<?php

use yii\db\Schema;
use yii\db\Migration;

class m160215_032401_change_approved_type_from_project extends Migration
{
    public function up()
    {
        $this->dropColumn('project', 'approved');
        $this->addColumn('project', 'approved', $this->boolean());

    }

    public function down()
    {
        echo "m160215_032401_change_approved_type_from_project cannot be reverted.\n";

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
