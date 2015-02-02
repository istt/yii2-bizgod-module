<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Order',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//             'id',
//             'customer_id',
//             'category_id',
            'order_name',
            'order_description:ntext',
            'order_status',
            // 'unit',
            // 'quantity',
            // 'order_type',
            // 'rfp_attach',
            // 'product_image',
            // 'budget',
            // 'order_date',
            // 'due_date',
            // 'billing_type',
            // 'delivery_type',
            // 'delivery_address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
