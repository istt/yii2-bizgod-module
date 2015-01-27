<?php

namespace istt\bizgod\controllers;

use Yii;
use istt\bizgod\models\Invite;
use istt\bizgod\models\InviteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InviteController implements the CRUD actions for Invite model.
 */
class InviteController extends Controller {
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
	 * Lists all Invite models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new InviteSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );

		return $this->render ( 'index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider
		] );
	}
	/**
	 * Lists all Invite models.
	 *
	 * @return mixed
	 */
	public function actionAdmin() {
		$searchModel = new InviteSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );

		return $this->render ( 'admin', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider
		] );
	}

	/**
	 * Displays a single Invite model.
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
	 * Creates a new Invite model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Invite ();

		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [
					'view',
					'id' => $model->id
			] );
		} else {
			return $this->render ( 'create', [
					'model' => $model
			] );
		}
	}

	/**
	 * Updates an existing Invite model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );

		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [
					'view',
					'id' => $model->id
			] );
		} else {
			return $this->render ( 'update', [
					'model' => $model
			] );
		}
	}

	/**
	 * Deletes an existing Invite model.
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
	 * Finds the Invite model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 * @return Invite the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Invite::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
