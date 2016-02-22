<?php

use yii\db\Migration;
use yii\db\Schema;

class m160222_151943_create_notification_table extends Migration
{
    public function up()
    {
        $this->createTable('notification', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'description' => Schema::TYPE_TEXT,
            'role' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_DATE,
            'viewed' => Schema::TYPE_BOOLEAN,
        ]);

        $this->createIndex('idx-notification-user_id', 'notification', 'user_id');

        $this->addForeignKey('fk-notification-user_id', 'notification', 'user_id', 'user', 'id');

    }

    public function down()
    {
        echo "m160222_151943_create_notification_table cannot be reverted.\n";

        $this->dropTable('notification');
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
