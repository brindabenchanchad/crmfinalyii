<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer}}`.
 */
class m220128_095006_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer}}', [
            'customer_id' => $this->primaryKey(),
            'opportunity_id' => $this->integer()->notNull(),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull()
        ]);

        $this->addForeignKey(
            'fk-customer-opportunity_id',
            'customer',
            'opportunity_id',
            'opportunity',
            'opportunity_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer}}');

        
        $this->dropForeignKey(
            'fk-customer-opportunity_id',
            'customer'
        );
    }
}
