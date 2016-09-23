<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\base\Calculation]].
 *
 * @see \app\models\base\Calculation
 */
class CalculationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\base\Calculation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\base\Calculation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
