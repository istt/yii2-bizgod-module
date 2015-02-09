<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use istt\bizgod\models\Category;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use istt\bizgod\models\Customer;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use kartik\widgets\FileInput;
use istt\bizgod\models\Order;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin([ 'options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'order_name',  [
		    		'addon' => [
		    			'prepend' =>[
		    				'content' => '<i class="glyphicon glyphicon-star"></i>'
		    			]
		    		]
		    	])->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'category_id')->dropDownList([null => Yii::t('app', '-- Select Category --')] + Category::CategoryOptions()) ?>

    <?= $form->field($model, 'order_description')->textarea(['rows' => 6]) ?>

    <div class="row">
		<div class="col-sm-6">
		    <?= $form->field($model, 'quantity')->textInput() ?>

		</div>
		<div class="col-sm-6">
		    <?= $form->field($model, 'unit')->textInput(['maxlength' => 255]) ?>

		</div>
	</div>


    <?= $form->field($model, 'order_type')->dropDownList(Order::typeOptions()) ?>

    <?= $form->field($model, 'formRfpAttach')->widget(FileInput::className(), []) ?>

    <?= $form->field($model, 'formProductImage')->widget(FileInput::className(), []) ?>

    <?= $form->field($model, 'budget',  [
		    		'addon' => [
		    			'prepend' =>[
		    				'content' => '<i class="glyphicon glyphicon-usd"></i>'
		    			]
		    		]
		    	])->textInput() ?>

    <div class="row">
    	<div class="col-md-6">
    		<?= $form->field($model, 'order_date')->widget(DatePicker::className()) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'due_date')->widget(DatePicker::className()) ?>
    	</div>
    </div>

    <?= $form->field($model, 'billing_type')->textInput() ?>

    <?= $form->field($model, 'delivery_type')->textInput() ?>

    <?= $form->field($model, 'delivery_address',  [
		    		'addon' => [
		    			'prepend' =>[
		    				'content' => '<i class="glyphicon glyphicon-map-marker"></i>'
		    			]
		    		]
		    	])->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php VarDumper::dump($model, 3, true); ?>