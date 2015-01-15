<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

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
//             'id',
//             'name',
            'description',
            'status:boolean',
//             'level',
//             'belongto',
//             'lft',
//             'rgt',
//             'root',
        ],
    ]) ?>

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

</div>
