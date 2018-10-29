<?php

use yii\db\Migration;

/**
 * Class m181026_214630_alter_tasks_table
 */
class m181026_214630_alter_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tasks', 'date_end', 'datetime');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tasks', 'date_end');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181026_214630_alter_tasks_table cannot be reverted.\n";

        return false;
    }
    */
}
