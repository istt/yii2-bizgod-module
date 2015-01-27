<?php

namespace istt\bizgod\controllers;

use Yii;
use istt\bizgod\models\Category;
use istt\bizgod\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller {
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
						'allowActions' => ['index']
				]
		];
	}

	/**
	 * Lists all Category models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new CategorySearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );

		return $this->render ( 'indexCategory', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider
		] );
	}
	/**
	 * Lists all Category models.
	 *
	 * @return mixed
	 */
	public function actionAdmin() {
		$searchModel = new CategorySearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );

		return $this->render ( 'adminCategory', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider
		] );
	}

	/**
	 * Displays a single Category model.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render ( 'viewCategory', [
				'model' => $this->findModel ( $id )
		] );
	}

	/**
	 * Creates a new Category model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Category ();
		$res = false;
		if ($model->load ( Yii::$app->request->post () ) && $model->validate ()) {
			$parent = Category::findOne ( $model->belongto );
			if ($parent) {
				$model->appendTo ( $parent );
				$res = $model->save ();
			} else {
				$res = $model->makeRoot ();
			}
		}
		if ($res) {
			Yii::$app->session->setFlash('success', Yii::t('bizgod', 'Successfully create new category!'));
			return $this->redirect ( [
					'view',
					'id' => $model->id
			] );
		} else {
			return $this->render ( 'createCategory', [
					'model' => $model
			] );
		}
	}

	/**
	 * Updates an existing Category model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );
		$oldParent = $model->belongto;
		$res = false;
		if ($model->load ( Yii::$app->request->post () )) {
			if (($model->belongto == 0 ) && (!$model->isRoot())){
				$res = $model->makeRoot();
			} else{
				$parent = Category::findOne ( $model->belongto );
				if ($parent && $parent->id && ($parent->id != $oldParent)){
					$model->appendTo ( $parent );
				}
				$res = $model->save ();
			}
		}
		if ($res) {
			Yii::$app->session->setFlash('success', Yii::t('bizgod', 'Successfully update category <em>{name}</em>!', ['name' => $model->name]));
			return $this->redirect ( [
					'view',
					'id' => $model->id
			] );
		} else {
			return $this->render ( 'updateCategory', [
					'model' => $model
			] );
		}
	}

	/**
	 * Deletes an existing Category model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$model = $this->findModel($id);
		if ($model->deleteWithChildren ()){
			Yii::$app->session->setFlash('success', Yii::t('bizgod', 'Successfully delete category!'));
		} else {
			Yii::$app->session->setFlash('error', Yii::t('bizgod', 'Cannot delete category!'));
			foreach ($model->getErrors() as $k => $errorMsg){
				Yii::$app->session->addFlash('error', Yii::t('bizgod', 'Cannot delete category!'));
			}
		}
		return $this->redirect ( [ 'index' ] );
	}

	/**
	 * Finds the Category model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 * @return Category the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Category::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
