<?php

namespace app\models\base;

use yii;

class Base extends yii\db\ActiveRecord
{

    public static function getListFilter($from, $to, $add = null, $fieldOrder = '')
    {
        $items = \yii\helpers\ArrayHelper::map(self::find()
                    ->orderBy($fieldOrder ? $fieldOrder : $from)
                    ->all(), $from, $to);
        if (!$add) {
            return $items;
        }
        if ($add === true) {
            $datas = [0 => '----- Не выбрано -----'];
        } else {
            $datas = $add;
        }
        foreach ($items as $fromAttr => $toAttr) {
            $datas[$fromAttr] = $toAttr;
        }
        return $datas;
    }
}
