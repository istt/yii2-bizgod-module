<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CategoryRegister */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Category Register',
]) . ' ' . $model->supplier_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category Registers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->supplier_id, 'url' => ['view', 'supplier_id' => $model->supplier_id, 'category_id' => $model->category_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="category-register-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
