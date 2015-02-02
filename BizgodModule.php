<?php

namespace istt\bizgod;

use istt\bizgod\models\User;
use Yii;
class BizgodModule extends \yii\base\Module
{
	public $urlPrefix = 'bizgod';
	public $urlRules = [];

// 	public function init(){
// 		Yii::$app->getUser()->identityClass = User::className();
// 		parent::init();
// 	}
}
