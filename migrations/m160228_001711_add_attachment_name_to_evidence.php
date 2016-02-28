<?php

use yii\db\Migration;

class m160228_001711_add_attachment_name_to_evidence extends Migration
{
    public function up()
    {
        $this->addColumn('evidence', 'attachment_name', \yii\db\sqlite\Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('evidence', 'attachment_name');
    }
}
