<?php

use yii\db\Migration;
use yii\db\Schema;

class m160222_145943_create_evidence_table extends Migration
{
    public function up()
    {
        $this->createTable('evidence', [
            'id' => Schema::TYPE_PK,
            'attachment_path' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_STRING,
            'accepted_date' => Schema::TYPE_DATE,
            'updated_at' => Schema::TYPE_DATE,
        ]);
    }

    public function down()
    {
        echo "m160222_145943_create_evidence_table cannot be reverted.\n";

        $this->dropTable('evidence');
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
