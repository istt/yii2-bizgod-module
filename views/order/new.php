<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use istt\bizgod\models\Category;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use istt\bizgod\models\Customer;
use yii\helpers\ArrayHelper;
use istt\bizgod\models\Order;
use kartik\widgets\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Order',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
		<div class="col-md-9 col-sm-6">
		    <?= $form->field($model, 'order_name',  [
				    		'addon' => [
				    			'prepend' =>[
				    				'content' => '<i class="glyphicon glyphicon-star"></i>'
				    			]
				    		]
				    	])->textInput(['maxlength' => 255]) ?>

		</div>
		<div class="col-md-3 col-sm-6">

			<?= $form->field($model, 'order_type')->dropDownList([
					Order::TYPE_ALL => Yii::t('bizgod', 'Invite All Suppliers'),
					Order::TYPE_LIMITED => Yii::t('bizgod', 'Limit for Certified Suppliers'),
					Order::TYPE_CUSTOM => Yii::t('bizgod', 'Select Supplier'),
			]) ?>
		</div>
	</div>

	<div class="row">
	<div class="col-md-9 col-sm-6">
	    <?= $form->field($model, 'category_id', [
				    		'addon' => [
				    			'prepend' =>[
				    				'content' => '<i class="glyphicon glyphicon-bookmark"></i>'
				    			]
				    		]
				    	])
	    ->dropDownList(
	    		[null => Yii::t('app', '-- Select Category --')] + Category::CategoryOptions()
	    ) ?>

	</div>
	<div class="col-md-3 col-sm-6">
		<?= $form->field($model, 'order_status',  [
		    		'addon' => [
		    			'prepend' =>[
		    				'content' => '<i class="glyphicon glyphicon-heart"></i>'
		    			]
		    		]
		    	])->dropDownList([1 => Yii::t('app', 'Enable'), 0  => Yii::t('app', 'Disable')]) ?>
	</div>
</div>




    <?= $form->field($model, 'order_description')->textarea(['rows' => 6]) ?>

    <div class="row">
		<div class="col-sm-3">
		    <?= $form->field($model, 'quantity')->textInput() ?>

		</div>
		<div class="col-sm-3">
		    <?= $form->field($model, 'unit')->textInput(['maxlength' => 255]) ?>

		</div>
		<div class="col-sm-3">
		    <?= $form->field($model, 'budget',  [
				    		'addon' => [
				    			'prepend' =>[
				    				'content' => '<i class="glyphicon glyphicon-usd"></i>'
				    			]
				    		]
				    	])->textInput() ?>
		</div>
		<div class="col-sm-3">
    		<?= $form->field($model, 'due_date')->widget(DatePicker::className()) ?>
    	</div>
	</div>





    <div class="row">
    	<div class="col-md-6">
    		<?php //= $form->field($model, 'order_date')->widget(DatePicker::className()) ?>
		    <?= $form->field($model, 'product_image')->widget(FileInput::className()) ?>
    	</div>
    	<div class="col-md-6">
		    <?= $form->field($model, 'rfp_attach')->widget(FileInput::className()) ?>
    		<?php // = $form->field($model, 'due_date')->widget(DatePicker::className()) ?>
    	</div>
    </div>

    <?= $form->field($model, 'billing_type')->textInput() ?>

    <?php /*= $form->field($model, 'customer_id')->widget(Select2::className(), [
    		// TODO: Add ajax support for this
    		'data' => ArrayHelper::map(Customer::find()->all(), 'id', 'username')
    ]) */?>

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

</div>
