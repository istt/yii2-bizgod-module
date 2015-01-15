<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use istt\bizgod\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_name',  [
		    		'addon' => [
		    			'prepend' =>[
		    				'content' => '<i class="glyphicon glyphicon-star"></i>'
		    			]
		    		]
		    	])->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'category_id')->dropDownList([null => Yii::t('app', '-- Select Category --')] + Category::CategoryOptions()) ?>

    <?= $form->field($model, 'order_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'order_status',  [
		    		'addon' => [
		    			'prepend' =>[
		    				'content' => '<i class="glyphicon glyphicon-heart"></i>'
		    			]
		    		]
		    	])->textInput() ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'order_type')->textInput() ?>

    <?= $form->field($model, 'rfp_attach')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'product_image')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'budget',  [
		    		'addon' => [
		    			'prepend' =>[
		    				'content' => '<i class="glyphicon glyphicon-usd"></i>'
		    			]
		    		]
		    	])->textInput() ?>

    <div class="row">
    	<div class="col-md-6">
    		<?= $form->field($model, 'order_date')->textInput() ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'due_date')->textInput() ?>
    	</div>
    </div>

    <?= $form->field($model, 'billing_type')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

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
