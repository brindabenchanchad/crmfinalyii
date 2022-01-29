<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee}}`.
 */
class m220128_092311_create_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee}}', [
            'employee_id' => $this->primaryKey(),
            'person_id' => $this->integer()->notNull(),
            'employee_designation' => $this->string()->notNull(),
            'employee_salary' => $this->integer()->notNull(),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
            'is_deleted' => $this->boolean()
        ]);

        $this->addForeignKey(
            'fk-employee-person_id',
            'employee',
            'person_id',
            'person',
            'person_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employee}}');

        $this->dropForeignKey(
            'fk-employee-person_id',
            'employee'
        );
    }
}
