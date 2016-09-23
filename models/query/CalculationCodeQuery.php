<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\base\CalculationCode]].
 *
 * @see \app\models\base\CalculationCode
 */
class CalculationCodeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\base\CalculationCode[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\base\CalculationCode|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
