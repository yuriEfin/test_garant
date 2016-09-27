<?php

namespace app\models;

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
class Calculation extends base\Calculation
{

    /**
     * Коды отчета
     */
    public $code;

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название отчета'),
            'text' => Yii::t('app', 'Текст отчета'),
            'created_at' => Yii::t('app', 'Создан'),
            'updated_at' => Yii::t('app', 'Обновлен'),
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->updated_at = $this->created_at = date('Y-m-d G:i:s');
        } else {
            $this->updated_at = date('Y-m-d G:i:s');
        }
        return parent::beforeSave($insert);
    }

    /**
     * После удаление основной модели удаляем коды этой модели
     * @return type
     */
    public function afterDelete()
    {
        if ($models = CalculationCode::findAll(['calculation_id' => $this->id])) {
            $this->deleteCode($models);
        }
        return parent::afterDelete();
    }

    public function afterSave($insert, $changedAttributes)
    {
        $list = false; // default (Если не найдены коды ничего не сохраниться)
        if ($this->text) {
            if (preg_match_all('/\{(.*[-|+])?(?=(\-|\+))?(\d+)*(?!\s+)\}/', $this->text, $m)) {
                $list = array_map(function($value) {
                    return preg_replace(['/{/', '/}/', '/\+/'], '', $value);
                }, $m[0]);
            }
        }
        if ($insert) {
            // scenario insert
            if ($list) {
                $this->saveCodeList($list);
            }
        } else {
            // scenario update
            if ($list) {
                $this->deleteCode(); // сначала удаляем все связанные коды
                $this->saveCodeList($list); // сохраняем новые - так быстрее чем обновлять каждый раз
            }
        }
        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * Один ко многим -
     * @return array - массив кодов по данной калькуляции
     */
    public function getCodeList()
    {
        return $this->hasMany(CalculationCode::className(), ['calculation_id' => 'id']);
    }

    /**
     * удаление всех кодов при обновлении
     * @var mixed array OR null $models = Данные моделей кодов, которые нужно удалить
     */
    public function deleteCode($models = null)
    {
        if (!$models) {
            if ($listCode = $this->getCodeList()->all()) {
                foreach ($listCode as $model) {
                    $model->delete(); // можно и deleteAll() но так больше контроля (можно проверить перед удалением каждое значение)
                }
            }
        } else {
            foreach ($models as $model) {
                $model->delete(); // можно и deleteAll() но так больше контроля (можно проверить перед удалением каждое значение)
            }
        }
    }

    /**
     * 
     * @param type $list
     * @return boolean
     */
    public function saveCodeList($list)
    {
        if (!$list) {
            return false;
        }
        foreach ($list as $code) {
            $modelCode = new CalculationCode();
            $modelCode->calculation_id = $this->id;
            $modelCode->code = $code;
            $modelCode->save();
        }
    }
}
