<?php

namespace istt\bizgod\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for NetworkOperator model.
 */
class DefaultController extends Controller
{

    /**
     * Lists all NetworkOperator models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
