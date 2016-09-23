<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%calculation}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $created_at
 * @property string $updated_at
 */
class Calculation extends Base
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%calculation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\CalculationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CalculationQuery(get_called_class());
    }

   
}
