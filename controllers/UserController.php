<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\ForbiddenHttpException;

class UserController extends AppController
{
    public function actionIndex()
    {
        return User::find()->all();
    }

    public function actionCreate()
    {
        if (!Yii::$app->request->isPost) {
            throw new ForbiddenHttpException('Only POST requests are allowed.');
        }

        $user = new User();
        $user->load(Yii::$app->request->post(), '');

        if ($user->validate() && $user->save()) {
            return [
                'status' => 'success',
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $user->errors,
        ];
    }
}
