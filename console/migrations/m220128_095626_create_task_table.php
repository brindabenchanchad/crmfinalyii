<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m220128_095626_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'task_id' => $this->primaryKey(),
            'task_name' => $this->string()->notNull(),
            'task_description' => $this->string()->notNull(),
            'task_date' => $this->date()->notNull(),
            'task_status' => $this->boolean()->notNull(),
            'employee_id' => $this->integer()->notNull(),
            'module_id' => $this->integer()->notNull(),
            'module_name' => $this->string()->notNull(),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-task-emp_id',
            'task',
            'employee_id',
            'employee',
            'employee_id'
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');

        $this->dropForeignKey(
            'fk-task-employee_id',
            'task'
        );
    }
}
