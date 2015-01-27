<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Category',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//             'id',
            ['attribute' => 'name', 'value' => function ($model, $key, $index, $column){
            	return str_repeat('--',$model->level) . ' ' . $model->name;
            }],
            'description',
            ['attribute' => 'status', 'value' => function($model, $key, $index, $column){
            	return ($model->status)?Yii::t('app', 'Yes'):Yii::t('app', 'No');
            },	'filter' => [Yii::t('app', 'No'), Yii::t('app', 'Yes')]
            ],
//             'level',
            // 'belongto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
