<?php

namespace app\controllers;

use app\behaviors\JsonBehavior;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class AppController extends Controller
{
    public function behaviors()
    {
        return [
            'json' => [
                'class' => JsonBehavior::class,
            ]
        ];
    }

    public function actions()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
    }

    public function beforeAction($action)
    {
        parent::beforeAction($action);

        if (Yii::$app->request->isGet) {
            $apiKey = Yii::$app->request->get('apiKey');
        } else {
            $apiKey = Yii::$app->request->post('apiKey');
        }

        if (!$apiKey || $apiKey !== $_ENV['API_KEY']) {
            throw new ForbiddenHttpException();
        }

        return true;
    }
}