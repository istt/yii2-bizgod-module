<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Response */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Response',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Responses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="response-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
