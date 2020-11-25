<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m201125_051248_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'access_token' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'third_name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'date_birth' => $this->date()->notNull(),
            'status' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}