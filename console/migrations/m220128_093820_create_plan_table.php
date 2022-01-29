<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%plan}}`.
 */
class m220128_093820_create_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%plan}}', [
            'plan_id' => $this->primaryKey(),
            'plan_name' => $this->string()->notNull(),
            'plan_description' => $this->string()->notNull(),
            'plan_duration' => $this->string()->notNull(),
            'plan_price' => $this->integer()->notNull(),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
            'is_deleted' => $this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%plan}}');
    }
}
