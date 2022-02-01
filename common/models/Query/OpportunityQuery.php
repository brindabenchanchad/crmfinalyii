<?php

namespace common\models\Query;

/**
 * This is the ActiveQuery class for [[\common\models\Opportunity]].
 *
 * @see \common\models\Opportunity
 */
class OpportunityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Opportunity[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Opportunity|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}