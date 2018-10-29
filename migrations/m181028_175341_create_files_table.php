<?php

use yii\db\Migration;

/**
 * Handles the creation of table `documents`.
 */
class m181028_175341_create_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('files', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),
            'path' => $this->string(255),
            'user_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('fk_files_tasks', 'files', 'task_id', 'tasks', 'id');
        $this->addForeignKey('fk_files_users', 'files', 'user_id', 'users', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('files');
    }
}
