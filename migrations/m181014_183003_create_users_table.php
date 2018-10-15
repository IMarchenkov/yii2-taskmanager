<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m181014_183003_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull(),
            'password' => $this->string(100)->notNull(),
            'role_id' => $this->integer()->defaultValue(1),
            'authKey' => $this->string(255),
            'accessToken' => $this->string(255)
        ]);

        $this->createIndex('ix_users_login', 'users', 'username', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
