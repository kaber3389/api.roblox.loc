<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class UserController extends Controller
{
    public function actions()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
    }

    public function actionIndex()
    {
        return User::find()->all();
    }

    public function actionCreate()
    {
        if (!Yii::$app->request->isPost) {
            throw new ForbiddenHttpException();
        }

        var_dump(Yii::$app->request->post());die;
    }
}
