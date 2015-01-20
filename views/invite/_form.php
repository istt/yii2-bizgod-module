<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use istt\bizgod\models\Order;
use istt\bizgod\models\Supplier;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Invite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->widget(Select2::className(), [
    		'data' => ArrayHelper::map(Order::find()->orderBy(['order_date' => 'DESC'])->all(), 'id', 'order_name')
    ]) ?>

    <?= $form->field($model, 'invite_type')->textInput() ?>

    <?= $form->field($model, 'supplier_id')->widget(Select2::className(), [
    		'data' => ArrayHelper::map(Supplier::find()->orderBy(['username' => 'ASC'])->all(), 'id', 'username')
    ]) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className()) ?>

    <?= $form->field($model, 'status')->dropDownList([Yii::t('app', 'Disable'), Yii::t('app', 'Enable')]) ?>

    <?= $form->field($model, 'data_msg')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
