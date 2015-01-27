<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */
?>
<div class="supplier-view">

    <h1><?= Html::a($model->email, ['supplier/view', 'id' => $model->id]) ?></h1>

    <address><?= $model->address; ?></address>

    <?php /*= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'password',
            'email:email',
            'phone',
            'address',
            'business_register',
            'certify',
            'score',
            'supplier_type',
        ],
    ]) */?>

</div>
