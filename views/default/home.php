<?php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>

<p class="pull-right">
        <?= Html::a(Yii::t('bizgod', 'New Order'), ['new-order'], ['class' => 'btn btn-primary']) ?>
</p>
<?= ListView::widget([
	'dataProvider' => $dataProvider,
	'itemView' => '_itemOrder',
])?>

