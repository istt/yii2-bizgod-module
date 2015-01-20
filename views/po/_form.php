<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use istt\bizgod\models\Order;
use istt\bizgod\models\Customer;
use istt\bizgod\models\Supplier;
use istt\bizgod\models\Invite;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $model app\models\Po */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="po-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->widget(Select2::className(), [
    		'data' => ArrayHelper::map(Order::find()->all(), 'id', 'order_name')
    ]) ?>

    <?= $form->field($model, 'customer_id')->widget(Select2::className(), [
    		'data' => ArrayHelper::map(Customer::find()->all(), 'id', 'username')
    ]) ?>

    <?= $form->field($model, 'supplier_id')->widget(Select2::className(), [
    		'data' => ArrayHelper::map(Supplier::find()->all(), 'id', 'username')
    ]) ?>

    <?= $form->field($model, 'invite_id')->widget(Select2::className(), [
    		'data' => ArrayHelper::map(Invite::find()->all(), 'id', 'id')
    ]) ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'po_status')->textInput() ?>

    <?= $form->field($model, 'billing_type')->textInput() ?>

    <?= $form->field($model, 'delivery_type')->textInput() ?>

    <?= $form->field($model, 'delivery_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php VarDumper::dump($model->getFirstErrors(), 1, true)?>