<?php

namespace istt\bizgod\controllers;

use Yii;
use istt\bizgod\models\Supplier;
use istt\bizgod\models\SupplierSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use istt\bizgod\models\User;
use yii\web\HttpException;
use dektrium\user\Finder;

/**
 * SupplierController implements the CRUD actions for Supplier model.
 */
class SupplierController extends Controller {
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
	 * Lists all Supplier models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new SupplierSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );

		return $this->render ( 'index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider
		] );
	}
	/**
	 * Admin all Supplier models.
	 *
	 * @return mixed
	 */
	public function actionAdmin() {
		$searchModel = new SupplierSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );

		return $this->render ( 'admin', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider
		] );
	}

	/**
	 * Displays a single Supplier model.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render ( 'view', [
				'model' => $this->findModel ( $id )
		] );
	}

	/**
	 * Creates a new Supplier model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$user = new User();
		$user->scenario = 'create';

		$model = new Supplier ();

		if ($user->load(Yii::$app->request->post()) && $user->save() && $model->load ( Yii::$app->request->post () )) {
			$model->user_id = $user->id;
			if ($model->save()){
				return $this->redirect ( [
						'view',
						'id' => $model->user_id
				] );
			} else throw new HttpException(500, "There was an error processing your request. Please try again.");
		} else {
			return $this->render ( 'create', [
					'model' => $model,
					'user' => $user,
			] );
		}
	}

	/**
	 * Updates an existing Supplier model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );
		$finder = Yii::createObject(['class' => Finder::className()]);
		$user = $finder->findUserById($model->user_id);
		$user->scenario = 'update';

		if ($user->load ( Yii::$app->request->post () ) && $user->save()
				&& $model->load ( Yii::$app->request->post () ) && $model->save () ) {
			return $this->redirect ( [
					'view',
					'id' => $model->user_id
			] );
		} else {
			return $this->render ( 'update', [
					'model' => $model,
					'user' => $user,
			] );
		}
	}

	/**
	 * Deletes an existing Supplier model.
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
	 * Finds the Supplier model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 * @return Supplier the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Supplier::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
