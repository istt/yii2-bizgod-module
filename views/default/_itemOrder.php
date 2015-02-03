<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

?>
<div class="order-view">

    <h3><?= Html::a($model->order_name, ['view-order', 'id' => $model->id]) ?></h3>

    <p>
        <?php //= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /*= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <div class="lead">
    	<?= $model->order_description; ?>
    </div>

<div class="row">
	<div class="col-md-9 col-sm-6">
	    <?= DetailView::widget([
	        'model' => $model,
	        'attributes' => [
	            'order_status:boolean',
	            'quantity',
	            'unit',
	            'order_type',
	//             'rfp_attach',
	//             'product_image',
	            'budget',
	            'order_date',
	            'due_date',
	            'billing_type',
	            'delivery_type',
	            'delivery_address',
	        ],
	    ]) ?>

	</div>
	<div class="col-md-3 col-sm-6">
	    <?= DetailView::widget([
	        'model' => $model,
	        'attributes' => [
	            'customer.full_name:ntext:Customer Name',
	            'customer.user.email:email:Customer Email',
	            'customer.mobile:ntext:Customer Phone',
	            'customer.address:ntext:Customer Address',
	            'category.name:ntext:Category',
	        ],
	    ]) ?>

	    <p class="pull-right">
	    	<?= Html::a(Yii::t('app', 'View'), ['view-order', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
	    </p>

	</div>
</div>


</div>
