<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Calculation */

$this->title = Yii::t('app', 'Update Calculation') . '  "' . $model->title . '"';

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calculations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

?>
<div class="calculation-update">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])

    ?>

</div>
