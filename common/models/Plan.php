<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property int $plan_id
 * @property string $plan_name
 * @property string $plan_description
 * @property string $plan_duration
 * @property int $plan_price
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $is_deleted
 *
 * @property Opportunity[] $opportunities
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_name', 'plan_description', 'plan_duration', 'plan_price'], 'required'],
            [['plan_price', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['plan_name', 'plan_description', 'plan_duration'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'plan_id' => 'Plan ID',
            'plan_name' => 'Plan Name',
            'plan_description' => 'Plan Description',
            'plan_duration' => 'Plan Duration',
            'plan_price' => 'Plan Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * Gets query for [[Opportunities]].
     *
     * @return \yii\db\ActiveQuery|\common\models\Query\OpportunityQuery
     */
    public function getOpportunities()
    {
        return $this->hasMany(Opportunity::className(), ['plan_id' => 'plan_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Query\PlanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Query\PlanQuery(get_called_class());
    }
}
