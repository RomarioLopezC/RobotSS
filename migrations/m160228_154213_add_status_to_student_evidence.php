<?php

use yii\db\Migration;

class m160228_154213_add_status_to_student_evidence extends Migration
{
    public function up()
    {
        $this->addColumn('student_evidence', 'status', \yii\db\mssql\Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('evidence', 'status');
    }
}
