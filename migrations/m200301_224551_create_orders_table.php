<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m200301_224551_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255),
            'email' => $this->string(255),
            'phone_number' => $this->string(50)->notNull(),
            'order_type' => $this->string(50)->notNull(),
            'order_value' => $this->decimal(),
            'scheduled_date' => $this->date()->notNull(),
            'street_address' => $this->string(255)->notNull(),
            'city' => $this->string(100)->notNull(),
            'state' => $this->string(100)->notNull(),
            'zip_code' => $this->string(50),
            'country' => $this->string(50)->notNull(),
            'latitude' => $this->decimal()->notNull(),
            'longitude' => $this->decimal()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
