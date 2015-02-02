<?php

namespace istt\bizgod\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use istt\bizgod\models\Order;
use istt\bizgod\models\Customer;
use yii\web\HttpException;
use istt\bizgod\models\OrderSearch;

/**
 * DefaultController implements the CRUD actions for NetworkOperator model.
 */
class DefaultController extends Controller
{
	public function actionIndex(){
		return $this->render('home');
	}

    /**
     * @return mixed
     */
    public function actionMyOrder()
    {
    	$searchModel = new OrderSearch ();
    	$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
    	$dataProvider->query->andFilterWhere(['customer_id' => Yii::$app->getUser()->getId()]);
        return $this->render('myOrder', [
        		'searchModel' => $searchModel,
        		'dataProvider' => $dataProvider
        ]);
    }

    public function actionNewOrder(){
    	$model = new Order();
    	$model->customer_id = Yii::$app->getUser()->getId();
    	$model->order_date = date('Y-m-d');

    	if ($model->load(Yii::$app->request->post()) && $model->save()) {
    		return $this->redirect(['view-order', 'id' => $model->id]);
    	} else {
	    	$model->due_date = date('Y-m-d', strtotime("+1 week"));
	    	$customer  = Customer::findOne(Yii::$app->getUser()->getId());
	    	if ($customer) $model->delivery_address = $customer->address;
    		return $this->render('createOrder', [
    				'model' => $model,
    		]);
    	}
    }
    public function actionViewOrder($id){
    	$model = Order::findOne($id);
    	if (!$model) throw new HttpException(404, "The requested order does not exists");

   		return $this->render('viewOrder', [
   				'model' => $model,
   		]);
    }
}
