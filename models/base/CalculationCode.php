<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%calculation_code}}".
 *
 * @property integer $calculation_id
 * @property string $code
 */
class CalculationCode extends Base
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%calculation_code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['calculation_id'], 'integer'],
            [['code'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'calculation_id' => Yii::t('app', 'Calculation ID'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\CalculationCodeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CalculationCodeQuery(get_called_class());
    }
}
