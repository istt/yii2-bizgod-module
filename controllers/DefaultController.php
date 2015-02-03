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
use istt\bizgod\models\ResponseSearch;
use yii\data\ActiveDataProvider;
use istt\bizgod\models\Response;
use istt\bizgod\models\Invite;

/**
 * DefaultController implements the CRUD actions for NetworkOperator model.
 */
class DefaultController extends Controller
{
	/**
	 * List all available order with response from customers
	 * @return Ambigous <string, string>
	 */
	public function actionIndex(){
		$searchModel = new OrderSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );

		return $this->render('home', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
		]);
	}

    /**
     *
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

    /**
     * Customer create a new order
     * @return \yii\web\Response|Ambigous <string, string>
     */
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
    /**
     * View a specific order information
     * @param unknown $id
     * @throws HttpException
     * @return Ambigous <string, string>
     */
    public function actionViewOrder($id){
    	$model = Order::findOne($id);
    	if (!$model) throw new HttpException(404, "The requested order does not exists");

    	$responses = new ActiveDataProvider([
    			'query' => $model->getResponses(),
    			'pagination' => false,
    	]);

   		return $this->render('viewOrder', [
   				'model' => $model,
   				'responses' => $responses
   		]);
    }

    /**
     * Filter orders by Category
     */
    public function actionOrders($category = null){
    	return $this->render('orders', []);
    }

    /**
     * SUPPLIERS PORTALS
     */
    /**
     * Add a response to user order
     * @return Ambigous <string, string>
     */
    public function actionNewResponse($invite_id){
    	$invite = Invite::findOne($invite_id);
    	if (!$invite) throw new HttpException(404, "The requested page could not be found. Are you sure you provide the right order ID?");
    	$model = new Response();
    	//$model->supplier_id = Yii::$app->getUser()->getId();
    	$model->invite_id = $invite->id;
    	$model->order_id = $invite->order_id;
    	$model->supplier_id = $invite->supplier_id;
    	$model->response_date = date('Y-m-d H:i:s');
    	$model->response_type = 1;
    	if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
    		return $this->redirect ( [ 'view-order', 'id' => $model->id ] );
    	} else {
    		return $this->render ( 'newResponse', [
    				'model' => $model
    		] );
    	}
    }



}
