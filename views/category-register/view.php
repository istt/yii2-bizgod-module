<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CategoryRegister */

$this->title = $model->supplier_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category Registers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-register-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'supplier_id' => $model->supplier_id, 'category_id' => $model->category_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'supplier_id' => $model->supplier_id, 'category_id' => $model->category_id], [
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
            'supplier_id',
            'category_id',
        ],
    ]) ?>

</div>
