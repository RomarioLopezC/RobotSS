<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160228_194020_url_row_notifications extends Migration
{
    public function up()
    {
        $this->addColumn('notification','url', Schema::TYPE_STRING. ' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('notification','url');
    }

}
