<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CategoryRegister */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Category Register',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category Registers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-register-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
