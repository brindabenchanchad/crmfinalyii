<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%person}}".
 *
 * @property int $person_id
 * @property string $firstname
 * @property string|null $middlename
 * @property string $lastname
 * @property int $contact_no
 * @property string $email_id
 * @property int|null $address_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Address $address
 * @property Employee[] $employees
 * @property Lead[] $leads
 * @property Opportunity[] $opportunities
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%person}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'contact_no', 'email_id'], 'required'],
            [['contact_no', 'address_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['firstname', 'middlename', 'lastname', 'email_id'], 'string', 'max' => 255],
            [['email_id'], 'unique'],
            [['contact_no'], 'unique'],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'address_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'firstname' => 'Firstname',
            'middlename' => 'Middlename',
            'lastname' => 'Lastname',
            'contact_no' => 'Contact No',
            'email_id' => 'Email ID',
            'address_id' => 'Address ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Address]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['address_id' => 'address_id']);
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['person_id' => 'person_id']);
    }

    /**
     * Gets query for [[Leads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeads()
    {
        return $this->hasMany(Lead::className(), ['person_id' => 'person_id']);
    }

    /**
     * Gets query for [[Opportunities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpportunities()
    {
        return $this->hasMany(Opportunity::className(), ['person_id' => 'person_id']);
    }
}
