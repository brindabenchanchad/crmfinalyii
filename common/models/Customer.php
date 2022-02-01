<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property int $customer_id
 * @property int $opportunity_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Opportunity $opportunity
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    //  public $opportunity_id = 1;
    //  public $customer_id = 1;
 
    
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['opportunity_id'], 'required'],
            [['opportunity_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['opportunity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Opportunity::className(), 'targetAttribute' => ['opportunity_id' => 'opportunity_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'opportunity_id' => 'Opportunity ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Opportunity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpportunity()
    {
        return $this->hasOne(Opportunity::className(), ['opportunity_id' => 'opportunity_id']);
    }

    public static function find()
    {
        return new \common\models\Query\CustomerQuery(get_called_class());
    }
}
