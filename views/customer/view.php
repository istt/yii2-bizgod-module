<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\VarDumper;
use kartik\grid\GridView;
use kartik\widgets\StarRating;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'password',
            'full_name',
            'mobile',
            'email:email',
            'address',
            'city',
            'status',
            'score',
            'customer_type',
        ],
    ]) ?>

</div>

<hr/>

<h3>Orders</h3>
	<?= GridView::widget([
		'dataProvider' => $orders,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'order_name',
			'order_description',
			'order_date',
			['class' => 'yii\grid\ActionColumn', 'controller' => 'order'],
		]
	])?>

	<h3>Purchase Orders</h3>
	<?= GridView::widget([
		'dataProvider' => $pos,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'delivery_date',
			'quantity',
			'unit',
			'price',
			'po_status',
			['class' => 'yii\grid\ActionColumn', 'controller' => 'po'],
		]
	])?>
<h3>Ratings</h3>
	<?= GridView::widget([
		'dataProvider' => $ratings,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'date',
			['attribute' => 'score', 'value' => function($model, $key, $index, $column){
				return StarRating::widget([
						'name' => 'score-' . $index,
						'value' => $model->score,
						'disabled' => true,
						'pluginOptions' => [
								'size' => 'xs',
								'readonly' => true,
        						'showClear' => false,
        						'showCaption' => false,
						]
				]);
			}, 'format' => 'raw'],
			'comment',
			['class' => 'yii\grid\ActionColumn', 'controller' => 'rating'],
		]
	])?>
