<?php
/**
 * Return a list of menu item suitable for display in the main Nav
 */
return [
	['label' => \Yii::t('bizgod', 'Bizgod'), 'url' => '#', 'items' => [
		['label' => \Yii::t('bizgod','Category'), 'url' => ['/bizgod/category/index']],
		['label' => \Yii::t('bizgod','Customer'), 'url' => ['/bizgod/customer/index']],
		['label' => \Yii::t('bizgod','Invite'), 'url' => ['/bizgod/invite/index']],
		['label' => \Yii::t('bizgod','Order'), 'url' => ['/bizgod/order/index']],
		['label' => \Yii::t('bizgod','Purchase Order'), 'url' => ['/bizgod/po/index']],
		['label' => \Yii::t('bizgod','Rating'), 'url' => ['/bizgod/rating/index']],
		['label' => \Yii::t('bizgod','Response'), 'url' => ['/bizgod/response/index']],
		['label' => \Yii::t('bizgod','Supplier'), 'url' => ['/bizgod/supplier/index']],
	]]
];