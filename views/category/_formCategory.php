<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use istt\bizgod\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    	<div class="col-md-9">
    		<?= $form->field($model, 'name', [
		    		'addon' => [
		    			'prepend' =>[
		    				'content' => '<i class="glyphicon glyphicon-star"></i>'
		    			]
		    		]
		    	])->textInput() ?>
    	</div>
    	<div class="col-md-3">
    		<?= $form->field($model, 'status', [
		    		'addon' => [
		    				'append' =>[
		    						'content' => '<i class="glyphicon glyphicon-heart"></i>'
		    			]
		    		]
		    ])->dropDownList(Category::statusOptions()) ?>
    	</div>
    </div>

    <?= $form->field($model, 'description')->textArea(['rows' => 5, 'cols' => 80]) ?>

    <?php // echo $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'belongto')->dropDownList([0 => Yii::t('app', '--- Select Parent ---')] + Category::CategoryOptions()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

 <ul>
    <?php foreach($model->children()->all() as $child): ?>
    	<li><?= $child->name; ?></li>
    <?php endforeach; ?>
    </ul>

    <ul>
    <?php foreach ($model->parents(1)->all() as $parent): ?>
    	<li><?= $parent->name; ?></li>
    <?php endforeach; ?>
    </ul>
