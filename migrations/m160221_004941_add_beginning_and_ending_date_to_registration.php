<?php

use yii\db\Migration;

class m160221_004941_add_beginning_and_ending_date_to_registration extends Migration
{
    public function up()
    {
        $this->addColumn('registration', 'beginning_date', $this->date());
        $this->addColumn('registration', 'ending_date', $this->date());
    }

    public function down()
    {
        echo "m160221_004941_add_beginning_and_ending_date_to_registration cannot be reverted.\n";

        $this->dropColumn('registration', 'beginning_date');
        $this->dropColumn('registration', 'ending_date');
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
