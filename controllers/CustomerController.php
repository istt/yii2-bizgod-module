<?php

namespace istt\bizgod\controllers;

use Yii;
use istt\bizgod\models\Customer;
use istt\bizgod\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use istt\bizgod\models\User;
use dektrium\user\Finder;
use yii\web\HttpException;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller {
	public function behaviors() {
		return [
				'verbs' => [
						'class' => VerbFilter::className (),
						'actions' => [
								'delete' => [
										'post'
								]
						]
				],
				'as access' => [
						'class' => 'mdm\admin\components\AccessControl',
						'allowActions' => [
								'index'
						]
				]
		];
	}

	/**
	 * Lists all Customer models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new CustomerSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );

		return $this->render ( 'index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider
		] );
	}
	/**
	 * Lists all Customer models.
	 *
	 * @return mixed
	 */
	public function actionAdmin() {
		$searchModel = new CustomerSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );

		return $this->render ( 'admin', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider
		] );
	}

	/**
	 * Displays a single Customer model.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render ( 'view', [
				'model' => $customer = $this->findModel ( $id ),
				'orders' => new ActiveDataProvider ( [
						'query' => $customer->getOrders ()
				] ),
				'pos' => new ActiveDataProvider ( [
						'query' => $customer->getPos ()
				] ),
				'ratings' => new ActiveDataProvider ( [
						'query' => $customer->getRatings ()
				] )
		] );
	}

	/**
	 * Creates a new Customer model along with associated user profile.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$user = \Yii::createObject([
				'class'    => User::className(),
				'scenario' => 'create',
		]);

		$model = new Customer ();

		if ($user->load(\Yii::$app->request->post()) && $model->load ( Yii::$app->request->post ()) && $user->save()) {
			$model->user_id = $user->id;
			if ($model->save()){
				return $this->redirect ( [
						'view',
						'id' => $model->user_id
				] );
			} else throw new HttpException(500, "There was an error processing your request. Please try again");
		} else {
			return $this->render ( 'create', [
					'model' => $model,
					'user' => $user
			] );
		}
	}

	/**
	 * Updates an existing Customer model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );
		$model->scenario = 'update';
		$finder = Yii::createObject(['class' => Finder::className()]);
		$user = $finder->findUserById($model->user_id);
		$user->scenario = 'update';

		if ($user->load( Yii::$app->request->post ()) && $user->save() && $model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [
					'view',
					'id' => $model->user_id
			] );
		} else {
			return $this->render ( 'update', [
					'model' => $model,
					'user' => $user
			] );
		}
	}

	/**
	 * Deletes an existing Customer model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel ( $id )->delete ();

		return $this->redirect ( [
				'index'
		] );
	}

	/**
	 * Finds the Customer model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 * @return Customer the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Customer::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
