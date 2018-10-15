<?php

use yii\db\Migration;

/**
 * Handles the creation of table `roles`.
 */
class m181015_194438_create_roles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('roles', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique()
        ]);

        $this->createIndex('ix_roles_id', 'roles', 'id', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('roles');
    }
}
