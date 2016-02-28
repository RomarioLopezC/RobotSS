<?php

use yii\db\Migration;

class m160228_153614_remove_status_from_evidence extends Migration
{
    public function up()
    {
        $this->dropColumn('evidence', 'status');
    }

    public function down()
    {
        echo "m160228_153614_remove_status_from_evidence cannot be reverted.\n";

        $this->addColumn('evidence', 'status', \yii\db\mssql\Schema::TYPE_STRING);
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
