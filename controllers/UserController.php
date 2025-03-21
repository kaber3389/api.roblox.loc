<?php

namespace app\controllers;

use app\dto\UserDTO;
use app\models\form\LoginForm;
use app\models\User;
use Yii;
use yii\web\ForbiddenHttpException;

class UserController extends AppController
{
    public function actionIndex()
    {
        $users = User::find()->all();

        $data = [];
        foreach ($users as $user) {
            $data[] = UserDTO::fromUser($user);
        }

        return $data;
    }

    public function actionLogin()
    {
        if (!Yii::$app->request->isPost) {
            throw new ForbiddenHttpException('Only POST requests are allowed.');
        }

        $loginForm = new LoginForm();
        if ($loginForm->load(Yii::$app->request->post(), '')) {
            if (!$loginForm->validate()) {
                return $this
                    ->asJson([])
                    ->setStatusCode(400, json_encode(['errors' => $loginForm->getErrors()]));
            }

            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'access_token11',
                'value' => 'your_jwt_token',
                'httpOnly' => true,
                'secure' => false,
                'sameSite' => 'Lax',
                'domain' => '172.23.35.130',
                'path' => '/',
            ]));

            return $this
                ->asJson(UserDTO::fromUser($loginForm->user))
                ->setStatusCode(200);
        }

        return $this
            ->asJson([])
            ->setStatusCode(400, json_encode(['errors' => 'Failed login. Invalid data.']));
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

            return $this
                ->asJson([])
                ->setStatusCode(400, json_encode(['errors' => $user->getErrors()]));
        }

        return [
            'status' => 'error',
            'message' => 'Failed to load data.',
        ];
    }
}
