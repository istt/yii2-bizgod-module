<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResponseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="response-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'invite_id') ?>

    <?= $form->field($model, 'supplier_id') ?>

    <?= $form->field($model, 'response_date') ?>

    <?php // echo $form->field($model, 'response_data') ?>

    <?php // echo $form->field($model, 'response_type') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
