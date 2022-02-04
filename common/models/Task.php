<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%task}}".
 *
 * @property int $task_id
 * @property string $task_name
 * @property string $task_description
 * @property string $task_date
 * @property int $task_status
 * @property int $employee_id
 * @property int $module_id
 * @property string $module_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Employee $employee
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%task}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_name', 'task_description', 'task_date', 'task_status', 'employee_id', 'module_id', 'module_name', 'created_at', 'updated_at'], 'required'],
            [['task_date', 'created_at', 'updated_at'], 'safe'],
            [['task_status', 'employee_id', 'module_id'], 'integer'],
            [['task_name', 'task_description', 'module_name'], 'string', 'max' => 255],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'employee_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'task_name' => 'Task Name',
            'task_description' => 'Task Description',
            'task_date' => 'Task Date',
            'task_status' => 'Task Status',
            'employee_id' => 'Employee ID',
            'module_id' => 'Module ID',
            'module_name' => 'Module Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['employee_id' => 'employee_id']);
    }
}
