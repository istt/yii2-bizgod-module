<?php

namespace istt\bizgod\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Html;
use istt\bizgod\models\Order;
use istt\bizgod\models\Supplier;
use istt\bizgod\models\Invite;
use yii\helpers\VarDumper;
use yii\helpers\Console;

/**
 * InviteController implements the CRUD actions for Invite model.
 */
class InviteController extends Controller {

	/**
	 * Lists all Invite models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$orders = Order::findAll(['order_status' => 1]);
		$suppliers = Supplier::find()->all();
		$res = 0;
		foreach ($orders as $order){
			foreach ($suppliers as $supplier){
				$invite = new Invite();
				$invite->invite_type = 0;
				$invite->order_id = $order->primaryKey;
				$invite->supplier_id = $supplier->primaryKey;
				$invite->data_msg = Yii::t("bizgod", "You have an order from {customer} biz on {description}: {url}", [
						'url' => Html::a($order->order_name, ['/default/view-order', 'id' => $order->id]),
						'description' => $order->order_description,
						'customer' => $order->customer?$order->customer->full_name:'',
				]);
				$invite->status = 0;
				$invite->date = date('Y-m-d H:i:s');
				if ($invite->save()){
					$res++;
				} else {
					VarDumper::dump($invite->errors);
				}
			}
		}
		echo $this->ansiFormat(Yii::t('bizgod', "\n\nSuccessfully create {res} invites from db\n\n", ['res' => $res]), Console::FG_GREEN);
	}
}
