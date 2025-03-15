<?php

use yii\db\Migration;

class m250315_195910_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(), // Первичный ключ
            'email' => $this->string()->notNull()->unique(), // Email, уникальный
            'full_name' => $this->string()->notNull(), // Полное имя
            'password' => $this->string()->notNull(), // Пароль
            'is_confirm_email' => $this->boolean()->defaultValue(false), // Подтверждение email
            'role' => $this->string()->notNull()->defaultValue('user'), // Роль пользователя
            'created_at' => $this->integer()->notNull(), // Дата создания
            'updated_at' => $this->integer()->notNull(), // Дата обновления
        ]);

        // Добавляем индекс для поля email (опционально)
        $this->createIndex(
            'idx-user-email',
            'user',
            'email'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250315_195910_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250315_195910_user cannot be reverted.\n";

        return false;
    }
    */
}
