<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%employee}}".
 *
 * @property int $employee_id
 * @property int $person_id
 * @property string $employee_designation
 * @property int $employee_salary
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $is_deleted
 *
 * @property Person $person
 * @property Task[] $tasks
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%employee}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'employee_designation', 'employee_salary', 'created_at', 'updated_at'], 'required'],
            [['person_id', 'employee_salary', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['employee_designation'], 'string', 'max' => 255],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'person_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'Employee ID',
            'person_id' => 'Person ID',
            'employee_designation' => 'Employee Designation',
            'employee_salary' => 'Employee Salary',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['person_id' => 'person_id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['employee_id' => 'employee_id']);
    }
}
