<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m181010_133012_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'email' => $this->string(),
            'password_hash' => $this->string(60),
            'auth_key' => $this->string(32),
            'confirmed_at' => $this->integer(),
            'blocked_at' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'last_login' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
