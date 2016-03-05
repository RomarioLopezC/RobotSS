<?php

use yii\db\Migration;

class m160227_151658_add_feedback_to_student_evidence extends Migration
{
    public function up()
    {
        $this->addColumn('student_evidence', 'comment', $this->string());
    }

    public function down()
    {
    }
}
