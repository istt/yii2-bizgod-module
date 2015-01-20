<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use istt\bizgod\models\Category;
use kartik\widgets\Select2;
use istt\bizgod\models\Supplier;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'business_register')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'certify')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'score')->textInput() ?>

    <?= $form->field($model, 'supplier_type')->dropDownList(Supplier::typeOptions()) ?>

    <?= $form->field($model, 'categoryIds')->widget(Select2::className(), [
    		'data' => Category::CategoryOptions(),
    		'options' => ['multiple' => true],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
