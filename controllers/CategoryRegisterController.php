<?php

namespace istt\bizgod\controllers;

use Yii;
use istt\bizgod\models\CategoryRegister;
use istt\bizgod\models\CategoryRegisterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryRegisterController implements the CRUD actions for CategoryRegister model.
 */
class CategoryRegisterController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CategoryRegister models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoryRegisterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all CategoryRegister models.
     * @return mixed
     */
    public function actionAdmin()
    {
        $searchModel = new CategoryRegisterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoryRegister model.
     * @param integer $supplier_id
     * @param integer $category_id
     * @return mixed
     */
    public function actionView($supplier_id, $category_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($supplier_id, $category_id),
        ]);
    }

    /**
     * Creates a new CategoryRegister model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoryRegister();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'supplier_id' => $model->supplier_id, 'category_id' => $model->category_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CategoryRegister model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $supplier_id
     * @param integer $category_id
     * @return mixed
     */
    public function actionUpdate($supplier_id, $category_id)
    {
        $model = $this->findModel($supplier_id, $category_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'supplier_id' => $model->supplier_id, 'category_id' => $model->category_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CategoryRegister model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $supplier_id
     * @param integer $category_id
     * @return mixed
     */
    public function actionDelete($supplier_id, $category_id)
    {
        $this->findModel($supplier_id, $category_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CategoryRegister model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $supplier_id
     * @param integer $category_id
     * @return CategoryRegister the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($supplier_id, $category_id)
    {
        if (($model = CategoryRegister::findOne(['supplier_id' => $supplier_id, 'category_id' => $category_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
