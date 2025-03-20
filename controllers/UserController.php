<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\ForbiddenHttpException;

class UserController extends AppController
{
    public function actionIndex()
    {
        return User::find()->addSelect(['email', 'username'])->all();
    }

    public function actionCreate()
    {
        if (!Yii::$app->request->isPost) {
            throw new ForbiddenHttpException('Only POST requests are allowed.');
        }

        $user = new User();
        if ($user->load(Yii::$app->request->post(), '')) {
            $user->setPasswordHash($user->password);
            $user->generateAuthKey();

            if ($user->validate() && $user->save()) {
                return [
                    'status' => 'success',
                    'message' => 'User created successfully.',
                ];
            }

            return [
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $user->errors,
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Failed to load data.',
        ];
    }
}
