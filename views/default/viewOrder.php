<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->order_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="pull-right">
        <?= Html::a(Yii::t('app', 'Response'), ['new-response', 'order_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//             'id',
//             'customer_id',
//             'category_id',
            'order_name',
            'order_description:ntext',
            'order_status:boolean',
            'quantity',
            'unit',
            'order_type',
            'rfp_attach',
            'product_image',
            'budget',
            'order_date',
            'due_date',
            'billing_type',
            'delivery_type',
            'delivery_address',
        ],
    ]) ?>

    <?= DetailView::widget([
        'model' => $model->fields
        ]); ?>

</div>

<?= GridView::widget([
	'dataProvider' => $responses,
	'columns' => [
		'response_date',
		'supplier.user.email:email',
		'response_data',
	]
])?>


