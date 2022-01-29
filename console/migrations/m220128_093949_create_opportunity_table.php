<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%opportunity}}`.
 */
class m220128_093949_create_opportunity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%opportunity}}', [
            'opportunity_id' => $this->primaryKey(),
            'lead_id' => $this->integer()->notNull(),
            'person_id' => $this->integer()->notNull(),
            'plan_id' => $this->integer()->notNull(),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull()
        ]);

        $this->addForeignKey(
            'fk-opportunity-lead_id',
            'opportunity',
            'lead_id',
            'lead',
            'lead_id'
        );

        $this->addForeignKey(
            'fk-opportunity-person_id',
            'opportunity',
            'person_id',
            'person',
            'person_id'
        );

        $this->addForeignKey(
            'fk-opportunity-plan_id',
            'opportunity',
            'plan_id',
            'plan',
            'plan_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%opportunity}}');

        $this->dropForeignKey(
            'fk-opportunity-lead_id',
            'opportunity'
        );

        $this->dropForeignKey(
            'fk-opportunity-person_id',
            'opportunity'
        );
    }
}
