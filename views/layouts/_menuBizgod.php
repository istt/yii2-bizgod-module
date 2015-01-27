<?php
/**
 * Return a list of menu item suitable for display in the main Nav
 */
$menuBizgod = [
		['label' => \Yii::t('bizgod','Category'), 'url' => ['/bizgod/category/index']],
		['label' => \Yii::t('bizgod','Customer'), 'url' => ['/bizgod/customer/index']],
		['label' => \Yii::t('bizgod','Invite'), 'url' => ['/bizgod/invite/index']],
		['label' => \Yii::t('bizgod','Order'), 'url' => ['/bizgod/order/index']],
		['label' => \Yii::t('bizgod','Purchase Order'), 'url' => ['/bizgod/po/index']],
		['label' => \Yii::t('bizgod','Rating'), 'url' => ['/bizgod/rating/index']],
		['label' => \Yii::t('bizgod','Response'), 'url' => ['/bizgod/response/index']],
		['label' => \Yii::t('bizgod','Supplier'), 'url' => ['/bizgod/supplier/index']],
];

$menuBizgodAdmin = [];
if (\Yii::$app->user->can('/bizgod/category/admin'))
	$menuBizgodAdmin[] = ['label' => \Yii::t('bizgod','Category Administration'), 'url' => ['/bizgod/category/admin']];
if (\Yii::$app->user->can('/bizgod/customer/admin'))
	$menuBizgodAdmin[] = ['label' => \Yii::t('bizgod','Customer Administration'), 'url' => ['/bizgod/customer/admin']];
if (\Yii::$app->user->can('/bizgod/supplier/admin'))
	$menuBizgodAdmin[] = ['label' => \Yii::t('bizgod','Supplier Administration'), 'url' => ['/bizgod/supplier/admin']];
if (\Yii::$app->user->can('/bizgod/po/admin'))
	$menuBizgodAdmin[] = ['label' => \Yii::t('bizgod','Purchase Order Administration'), 'url' => ['/bizgod/po/admin']];
if (\Yii::$app->user->can('/bizgod/rating/admin'))
	$menuBizgodAdmin[] = ['label' => \Yii::t('bizgod','Rating Administration'), 'url' => ['/bizgod/rating/admin']];
if (\Yii::$app->user->can('/bizgod/response/admin'))
	$menuBizgodAdmin[] = ['label' => \Yii::t('bizgod','Response Administration'), 'url' => ['/bizgod/response/admin']];
if (\Yii::$app->user->can('/bizgod/order/admin'))
	$menuBizgodAdmin[] = ['label' => \Yii::t('bizgod','Response Administration'), 'url' => ['/bizgod/order/admin']];
if (\Yii::$app->user->can('/bizgod/invite/admin'))
	$menuBizgodAdmin[] = ['label' => \Yii::t('bizgod','Response Administration'), 'url' => ['/bizgod/invite/admin']];

if ($menuBizgodAdmin){
	$menuBizgod[] = '<li class="divider"></li>';
	$menuBizgod = array_merge($menuBizgod, $menuBizgodAdmin);
}

return $menuBizgod;