<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m181015_213651_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'task_name' => $this->string(255),
            'task_creater_id' => $this->integer(50),
            'task_owner_id' => $this->integer(50),
            'description' => $this->text(),
            'date_start' => $this->date(),
            'date_end' => $this->date(),
            'date_created' => $this->date()
        ]);

        $this->createIndex('ix_tasks_id', 'tasks', 'id', true);

        $this->createTable('tasks_users', [
            'task_id' => $this->primaryKey(),
            'user_id' =>$this->integer(50)
        ]);

        $this->createIndex('ix_tasks_users_task_id', 'tasks_users', 'task_id', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tasks');
        $this->dropTable('tasks_users');
    }
}
